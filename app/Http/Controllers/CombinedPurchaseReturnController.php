<?php

namespace App\Http\Controllers;

use App\TaxRate;
use App\Transaction;
use App\PurchaseLine;
use App\BusinessLocation;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use Illuminate\Http\Request;
use App\Utils\TransactionUtil;
use Illuminate\Support\Facades\DB;
use Modules\Accounting\Entities\Mapping;
use Modules\Accounting\Entities\AccountingAccTransMapping;
use Modules\Accounting\Entities\AccountingAccountsTransaction;

class CombinedPurchaseReturnController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $productUtil;

    protected $moduleUtil;

    protected $transactionUtil;

    /**
     * Constructor
     *
     * @param  ProductUtils  $product
     * @return void
     */
    public function __construct(ProductUtil $productUtil, ModuleUtil $moduleUtil, TransactionUtil $transactionUtil)
    {
        $this->productUtil = $productUtil;
        $this->moduleUtil = $moduleUtil;
        $this->transactionUtil = $transactionUtil;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('purchase.update')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        //Check if subscribed or not
        if (!$this->moduleUtil->isSubscribed($business_id)) {
            return $this->moduleUtil->expiredResponse();
        }

        $business_locations = BusinessLocation::forDropdown($business_id);

        $taxes = TaxRate::where('business_id', $business_id)
            ->ExcludeForTaxGroup()
            ->get();

        return view('purchase_return.create')
            ->with(compact('business_locations', 'taxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {


        if (!auth()->user()->can('purchase.update')) {
            abort(403, 'Unauthorized action.');
        }
        $user_id = $request->session()->get('user.id');

        $type = $request->get('type');

        try {
            DB::beginTransaction();

            $input_data = $request->only([
                'location_id',
                'transaction_date',
                'final_total',
                'ref_no',
                'tax_id',
                'tax_amount',
                'contact_id',
            ]);
            $business_id = $request->session()->get('user.business_id');

            //Check if subscribed or not
            if (!$this->moduleUtil->isSubscribed($business_id)) {
                return $this->moduleUtil->expiredResponse();
            }

            $user_id = $request->session()->get('user.id');

            $input_data['type'] = 'purchase_return';
            $input_data['business_id'] = $business_id;
            $input_data['created_by'] = $user_id;
            $input_data['transaction_date'] = $this->productUtil->uf_date($input_data['transaction_date'], true);
            $input_data['total_before_tax'] = $input_data['final_total'] - $input_data['tax_amount'];

            //Update reference count
            $ref_count = $this->productUtil->setAndGetReferenceCount('purchase_return');
            //Generate reference number
            if (empty($input_data['ref_no'])) {
                $input_data['ref_no'] = $this->productUtil->generateReferenceNumber('purchase_return', $ref_count);
            }

            //upload document
            $input_data['document'] = $this->productUtil->uploadFile($request, 'document', 'documents');

            $products = $request->input('products');

            if (!empty($products)) {
                $product_data = [];

                foreach ($products as $product) {
                    $unit_price = $this->productUtil->num_uf($product['unit_price']);
                    $return_line = [
                        'product_id' => $product['product_id'],
                        'variation_id' => $product['variation_id'],
                        'quantity' => 0,
                        'purchase_price' => $unit_price,
                        'pp_without_discount' => $unit_price,
                        'purchase_price_inc_tax' => $unit_price,
                        'quantity_returned' => $this->productUtil->num_uf($product['quantity']),
                        'lot_number' => !empty($product['lot_number']) ? $product['lot_number'] : null,
                        'exp_date' => !empty($product['exp_date']) ? $this->productUtil->uf_date($product['exp_date']) : null,
                    ];

                    $product_data[] = $return_line;

                    //Decrease available quantity
                    $this->productUtil->decreaseProductQuantity(
                        $product['product_id'],
                        $product['variation_id'],
                        $input_data['location_id'],
                        $this->productUtil->num_uf($product['quantity'])
                    );
                }

                $purchase_return = Transaction::create($input_data);
                $purchase_return->purchase_lines()->createMany($product_data);

                            // ======================= حفظ قيد تلقائي  ====================
            $user_id = auth()->user()->id;
            $mapping = Mapping::where('business_id', $business_id)->get();

            $business_id = $request->session()->get('user.business_id');
            $transaction_data = $request->only(['ref_no', 'status', 'contact_id', 'transaction_date', 'total_before_tax', 'location_id', 'discount_type', 'discount_amount', 'tax_id', 'tax_amount', 'shipping_details', 'shipping_charges', 'final_total', 'additional_notes', 'exchange_rate', 'pay_term_number', 'pay_term_type', 'purchase_order_ids']);
    
            $acc_trans_mapping = new AccountingAccTransMapping();
            $acc_trans_mapping['business_id'] = $business_id;
            $acc_trans_mapping['ref_no'] = $purchase_return->ref_no;
            $acc_trans_mapping['note'] = $request->get('note');
            $acc_trans_mapping['type'] = 'Purchase Return';
            $acc_trans_mapping['type1'] = 'قيد تلقائي';
    
            $acc_trans_mapping['created_by'] = $user_id;
            $acc_trans_mapping['operation_date'] = $this->productUtil->uf_date($transaction_data['transaction_date'], true);
    
            
            $acc_trans_mapping->save();
    //    dd($acc_trans_mapping);
    
        
            //$payment_account will increase = sales = credit
            $payment_data = [
                'accounting_account_id' => $mapping->purch_acc_id,
                'transaction_id' => $purchase_return->id,
                'transaction_payment_id' => null,
                'amount' => $purchase_return->final_total,
                'acc_trans_mapping_id' =>  $acc_trans_mapping->id,
                'type' => 'credit',
                'business_id1' => $business_id,
                'sub_type' => $purchase_return->type,
                'map_type' => 'payment_account',
                'created_by' => $user_id,
                'operation_date' => \Carbon::now(),
            ];
 

            //Deposit to will increase = debit
            $deposit_data = [
                'accounting_account_id' => $mapping->suppliers_acc_id,
                'transaction_id' => $purchase_return->id,
                'transaction_payment_id' => null,
                'amount' => $purchase_return->final_total,
                'acc_trans_mapping_id' => $acc_trans_mapping->id,
                'type' => 'debit',
                'business_id1' => $business_id,
                'sub_type' => $purchase_return->type,
                'map_type' => 'deposit_to',
                'created_by' => $user_id,
                'operation_date' => \Carbon::now(),
            ];
            // dd($payment_data,$deposit_data);
            // dd($deposit_data);
            AccountingAccountsTransaction::updateOrCreateMapTransaction($payment_data);
            AccountingAccountsTransaction::updateOrCreateMapTransaction($deposit_data);
            // ======================================================
            // dd( $purchase_return);

                //update payment status
                $this->transactionUtil->updatePaymentStatus($purchase_return->id, $purchase_return->final_total);
            }
            $output = [
                'success' => 1,
                'msg' => __('lang_v1.purchase_return_added_success'),
            ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect('purchase-return')->with('status', $output);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('purchase.update')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $purchase_return = Transaction::where('business_id', $business_id)
            ->with(['contact'])
            ->find($id);
        $location_id = $purchase_return->location_id;
        $purchase_lines = PurchaseLine::join(
            'products AS p',
            'purchase_lines.product_id',
            '=',
            'p.id'
        )
            ->join(
                'variations AS variations',
                'purchase_lines.variation_id',
                '=',
                'variations.id'
            )
            ->join(
                'product_variations AS pv',
                'variations.product_variation_id',
                '=',
                'pv.id'
            )
            ->leftjoin('variation_location_details AS vld', function ($join) use ($location_id) {
                $join->on('variations.id', '=', 'vld.variation_id')
                    ->where('vld.location_id', '=', $location_id);
            })
            ->leftjoin('units', 'units.id', '=', 'p.unit_id')
            ->where('purchase_lines.transaction_id', $id)
            ->select(
                DB::raw("IF(pv.is_dummy = 0, CONCAT(p.name, 
                                    ' (', pv.name, ':',variations.name, ')'), p.name) AS product_name"),
                'p.id as product_id',
                'p.enable_stock',
                'pv.is_dummy as is_dummy',
                'variations.sub_sku',
                'vld.qty_available',
                'variations.id as variation_id',
                'units.short_name as unit',
                'units.allow_decimal as unit_allow_decimal',
                'purchase_lines.purchase_price',
                'purchase_lines.id as purchase_line_id',
                'purchase_lines.quantity_returned as quantity_returned',
                'purchase_lines.lot_number',
                'purchase_lines.exp_date'
            )
            ->get();

        foreach ($purchase_lines as $key => $value) {
            $purchase_lines[$key]->qty_available += $value->quantity_returned;
            $purchase_lines[$key]->formatted_qty_available = $this->productUtil->num_f($purchase_lines[$key]->qty_available);
        }

        $business_locations = BusinessLocation::forDropdown($business_id);

        $taxes = TaxRate::where('business_id', $business_id)
            ->ExcludeForTaxGroup()
            ->get();

        return view('purchase_return.edit')
            ->with(compact('business_locations', 'taxes', 'purchase_return', 'purchase_lines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!auth()->user()->can('purchase.update')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            DB::beginTransaction();

            $input_data = $request->only([
                'transaction_date',
                'final_total',
                'tax_id',
                'tax_amount',
                'contact_id',
            ]);
            $business_id = $request->session()->get('user.business_id');

            if (!empty($request->input('ref_no'))) {
                $input_data['ref_no'] = $request->input('ref_no');
            }

            //Check if subscribed or not
            if (!$this->moduleUtil->isSubscribed($business_id)) {
                return $this->moduleUtil->expiredResponse();
            }

            $input_data['transaction_date'] = $this->productUtil->uf_date($input_data['transaction_date'], true);
            $input_data['total_before_tax'] = $input_data['final_total'] - $input_data['tax_amount'];

            //upload document
            $doc_name = $this->productUtil->uploadFile($request, 'document', 'documents');

            if (!empty($doc_name)) {
                $input_data['document'] = $doc_name;
            }

            $products = $request->input('products');
            $purchase_return_id = $request->input('purchase_return_id');
            $purchase_return = Transaction::where('business_id', $business_id)
                ->where('type', 'purchase_return')
                ->find($purchase_return_id);

            if (!empty($products)) {
                $product_data = [];
                $updated_purchase_lines = [];

                foreach ($products as $product) {
                    $unit_price = $this->productUtil->num_uf($product['unit_price']);
                    if (!empty($product['purchase_line_id'])) {
                        $return_line = PurchaseLine::find($product['purchase_line_id']);
                        $updated_purchase_lines[] = $return_line->id;

                        $this->productUtil->decreaseProductQuantity(
                            $product['product_id'],
                            $product['variation_id'],
                            $purchase_return->location_id,
                            $this->productUtil->num_uf($product['quantity']),
                            $return_line->quantity_returned
                        );
                    } else {
                        $return_line = new PurchaseLine([
                            'product_id' => $product['product_id'],
                            'variation_id' => $product['variation_id'],
                            'quantity' => 0,
                        ]);

                        //Decrease available quantity
                        $this->productUtil->decreaseProductQuantity(
                            $product['product_id'],
                            $product['variation_id'],
                            $purchase_return->location_id,
                            $this->productUtil->num_uf($product['quantity'])
                        );
                    }
                    $return_line->purchase_price = $unit_price;
                    $return_line->pp_without_discount = $unit_price;
                    $return_line->purchase_price_inc_tax = $unit_price;
                    $return_line->quantity_returned = $this->productUtil->num_uf($product['quantity']);
                    $return_line->lot_number = !empty($product['lot_number']) ? $product['lot_number'] : null;
                    $return_line->exp_date = !empty($product['exp_date']) ? $this->productUtil->uf_date($product['exp_date']) : null;
                    $product_data[] = $return_line;
                }

                $purchase_return->update($input_data);

                //If purchase line deleted add return quantity to stock
                $deleted_purchase_lines = PurchaseLine::where('transaction_id', $purchase_return_id)
                    ->whereNotIn('id', $updated_purchase_lines)
                    ->get();

                foreach ($deleted_purchase_lines as $dpl) {
                    $this->productUtil->updateProductQuantity($purchase_return->location_id, $dpl->product_id, $dpl->variation_id, $dpl->quantity_returned, 0, null, false);
                }

                PurchaseLine::where('transaction_id', $purchase_return_id)
                    ->whereNotIn('id', $updated_purchase_lines)
                    ->delete();

                $purchase_return->purchase_lines()->saveMany($product_data);

                //update payment status
                $this->transactionUtil->updatePaymentStatus($purchase_return->id, $purchase_return->final_total);
            }

            $output = [
                'success' => 1,
                'msg' => __('lang_v1.purchase_return_updated_success'),
            ];

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            \Log::emergency('File:' . $e->getFile() . 'Line:' . $e->getLine() . 'Message:' . $e->getMessage());

            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return redirect('purchase-return')->with('status', $output);
    }

    /**
     * Return product rows
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProductRow(Request $request)
    {
        if (request()->ajax()) {
            $row_index = $request->input('row_index');
            $variation_id = $request->input('variation_id');
            $location_id = $request->input('location_id');

            $business_id = $request->session()->get('user.business_id');
            $product = $this->productUtil->getDetailsFromVariation($variation_id, $business_id, $location_id);
            $product->formatted_qty_available = $this->productUtil->num_f($product->qty_available);

            return view('purchase_return.partials.product_table_row')
                ->with(compact('product', 'row_index'));
        }
    }
}
