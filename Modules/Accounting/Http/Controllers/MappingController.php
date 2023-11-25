<?php

namespace Modules\Accounting\Http\Controllers;

use App\Business;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Accounting\Entities\AccountingAccount;
use Modules\Accounting\Entities\Mapping;
use Illuminate\Contracts\Support\Renderable;
class MappingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('accounting::mapping');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('accounting::chart_of_accounts.mapping')->with(compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('accounting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit()
    {
        $business_id = request()->session()->get('user.business_id');

        $mapping1 = [];
        $accounts = AccountingAccount::where('business_id', $business_id)->get();
        $mapping2 = Mapping::where('business_id', $business_id)->get();
    //    dd(count($mapping2));
        if(count($mapping2) == 0)
        {

            $mapping1['business_id'] = $business_id;
            $mapping1['sales_acc_id'] = $business_id;
            $mapping = Mapping::create($mapping1);

            return view('accounting::chart_of_accounts.mapping')->with(compact('accounts','mapping'));
    

        }
        else
        {
            $mapping3 = Mapping::where('business_id', $business_id)->get();

            $mapping = $mapping3[0];
            return view('accounting::chart_of_accounts.mapping')->with(compact('accounts','mapping'));


        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // $business_id = request()->session()->get('user.business_id');

        // if (! (auth()->user()->can('superadmin') || ($this->moduleUtil->hasThePermissionInSubscription($business_id,
        // 'accounting_module')))) {
        //     abort(403, 'Unauthorized action.');
        // }

        
        // try {
        //     DB::beginTransaction();

            $input = $request->only(['stock_acc_id',
                     'discount_earned_acc_id',
                    'Value_added_tax_on_purchases_acc_id',
                     'shipping_expenses_acc_id',
                    'sales_revenue_acc_id',
                     'discount_permitted_acc_id', 
                     'value_added_tax_on_sales_acc_id', 
                    'shipping_revenue_acc_id',
                    'suppliers_acc_id',
                    'customers_acc_id',
                    'khazine_acc_id',
                    'cost_of_goods_acc_id',
                    
                    // 'empl_solfa_acc_id',
                    // 'sales_tax_acc_id','sales_perc_acc_id',
                    // 'purch_tax_acc_id','purch_perc_acc_id',
                    // 'expense_acc','current_assets_acc_id','income_papers_acc_id',
                    // 'madinon_acc_id','sales_incentive_acc_id','service_income_acc_id',
                    // 'daenon_acc_id','expense_papers_acc_id','fixed_assets_acc_id','currency',
                    // 'invoice_items_count','stock_acc_id','damaged_stock_acc_id','ingred_store_acc_id'

                    ]);
             $business_id = request()->session()->get('user.business_id');

                    $mapping =Mapping::where('business_id', $business_id);
                    // dd($input);
                    $mapping->update($input);

        //     $output = ['success' => true,
        //         'msg' => __('lang_v1.updated_success'),
        //     ];
        // } catch (\Exception $e) {
        //     \Log::emergency('File:'.$e->getFile().'Line:'.$e->getLine().'Message:'.$e->getMessage());

        //     $output = ['success' => false,
        //         'msg' => __('messages.something_went_wrong'),
        //     ];
        // }

        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
