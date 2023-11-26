@extends('layouts.app')
@section('title', __('product.edit_product'))

@section('content')



    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('accounting::lang.mapping')</h1>
        <!-- <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol> -->
    </section>
        {{-- @php
            dd($mapping);
        @endphp --}}
    <!-- Main content -->
    <section class="content">
        {!! Form::open([
            'url' => action([\Modules\Accounting\Http\Controllers\MappingController::class, 'update'], [$mapping->id]),
            'method' => 'PUT',
            'id' => 'product_add_form',
            'class' => 'product_form',
            'files' => true,
        ]) !!}
        <div class="card">
            <div class="card-header">
                <h3>@lang('accounting::lang.purch')</h3>

            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('stock_acc_id', __('accounting::lang.stock_acc_id') . ':') !!}
                            <select class="form-control select2" name="stock_acc_id" id="stock_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->stock_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('discount_earned_acc_id', __('accounting::lang.discount_earned_acc_id') . ':') !!}
                            <select class="form-control select2" name="discount_earned_acc_id" id="discount_earned_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->discount_earned_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Value_added_tax_on_purchases_acc_id', __('accounting::lang.Value_added_tax_on_purchases_acc_id') . ':') !!}
                            <select class="form-control select2" name="Value_added_tax_on_purchases_acc_id" id="Value_added_tax_on_purchases_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->Value_added_tax_on_purchases_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('shipping_expenses_acc_id', __('accounting::lang.shipping_expenses_acc_id') . ':') !!}
                            <select class="form-control select2" name="shipping_expenses_acc_id" id="shipping_expenses_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->shipping_expenses_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('suppliers_acc_id', __('accounting::lang.suppliers_acc_id') . ':') !!}
                            <select class="form-control select2" name="suppliers_acc_id" id="suppliers_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->suppliers_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('khazine_acc_id', __('accounting::lang.khazine_acc_id') . ':') !!}
                            <select class="form-control select2" name="khazine_acc_id" id="khazine_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->khazine_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>@lang('accounting::lang.sale')</h3>

            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('sales_revenue_acc_id', __('accounting::lang.sales_revenue_acc_id') . ':') !!}
                            <select class="form-control select2" name="sales_revenue_acc_id" id="sales_revenue_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->sales_revenue_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('discount_permitted_acc_id', __('accounting::lang.discount_permitted_acc_id') . ':') !!}
                            <select class="form-control select2" name="discount_permitted_acc_id" id="discount_permitted_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->discount_permitted_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('value_added_tax_on_sales_acc_id', __('accounting::lang.value_added_tax_on_sales_acc_id') . ':') !!}
                            <select class="form-control select2" name="value_added_tax_on_sales_acc_id" id="value_added_tax_on_sales_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}"
                                        @if ($mapping->value_added_tax_on_sales_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('shipping_revenue_acc_id', __('accounting::lang.shipping_revenue_acc_id') . ':') !!}
                            <select class="form-control select2" name="shipping_revenue_acc_id" id="shipping_revenue_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}"
                                        @if ($mapping->shipping_revenue_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('cost_of_goods_acc_id', __('accounting::lang.cost_of_goods_acc_id') . ':') !!}
                            <select class="form-control select2" name="cost_of_goods_acc_id" id="cost_of_goods_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}"
                                        @if ($mapping->cost_of_goods_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('customers_acc_id', __('accounting::lang.customers_acc_id') . ':') !!}
                            <select class="form-control select2" name="customers_acc_id" id="customers_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}"
                                        @if ($mapping->customers_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            

            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('accounting::lang.ohda')</h3>

                    </div>
                    <div class="card-body">
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('accounting::lang.mon')</h3>

                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('khazine_acc_id', __('accounting::lang.khazine_acc_id') . ':') !!}
                                    <select class="form-control select2" name="khazine_acc_id" id="khazine_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->khazine_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('bank_acc_id', __('accounting::lang.bank_acc_id') . ':') !!}
                                    <select class="form-control select2" name="bank_acc_id" id="bank_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->bank_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <div class="card">
            <div class="card-header">
                <h3>@lang('accounting::lang.tax')</h3>

            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('sales_tax_acc_id', __('accounting::lang.sales_tax_acc_id') . ':') !!}
                            <select class="form-control select2" name="sales_tax_acc_id" id="sales_tax_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->sales_tax_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('sales_perc_acc_id', __('accounting::lang.sales_perc_acc_id') . ':') !!}
                            <input class="form-group" type="number" name="sales_perc_acc_id" value="{{$mapping->sales_perc_acc_id}}" id="sales_perc_acc_id">
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('purch_tax_acc_id', __('accounting::lang.purch_tax_acc_id') . ':') !!}
                            <select class="form-control select2" name="purch_tax_acc_id" id="purch_tax_acc_id">
                                <option value="">@lang('messages.please_select')</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}" @if ($mapping->purch_tax_acc_id == $account->id) selected @endif>
                                        {{ $account->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('purch_perc_acc_id', __('accounting::lang.purch_perc_acc_id') . ':') !!}
                            <input class="form-group" type="number" name="purch_perc_acc_id" value="{{$mapping->purch_perc_acc_id}}" id="purch_perc_acc_id">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('accounting::lang.madine')</h3>

                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('expense_acc', __('accounting::lang.expense_acc') . ':') !!}
                                    <select class="form-control select2" name="expense_acc" id="expense_acc">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->expense_acc == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('madinon_acc_id', __('accounting::lang.madinon_acc_id') . ':') !!}
                                    <select class="form-control select2" name="madinon_acc_id" id="madinon_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->madinon_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('income_papers_acc_id', __('accounting::lang.income_papers_acc_id') . ':') !!}
                                    <select class="form-control select2" name="income_papers_acc_id" id="income_papers_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->income_papers_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('sales_incentive_acc_id', __('accounting::lang.sales_incentive_acc_id') . ':') !!}
                                    <select class="form-control select2" name="sales_incentive_acc_id" id="sales_incentive_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->sales_incentive_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('current_assets_acc_id', __('accounting::lang.current_assets_acc_id') . ':') !!}
                                    <select class="form-control select2" name="current_assets_acc_id" id="current_assets_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->current_assets_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('accounting::lang.madine')</h3>

                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('service_income_acc_id', __('accounting::lang.service_income_acc_id') . ':') !!}
                                    <select class="form-control select2" name="service_income_acc_id" id="service_income_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->service_income_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('daenon_acc_id', __('accounting::lang.daenon_acc_id') . ':') !!}
                                    <select class="form-control select2" name="daenon_acc_id" id="daenon_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->daenon_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('expense_papers_acc_id', __('accounting::lang.expense_papers_acc_id') . ':') !!}
                                    <select class="form-control select2" name="expense_papers_acc_id" id="expense_papers_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->expense_papers_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('fixed_assets_acc_id', __('accounting::lang.fixed_assets_acc_id') . ':') !!}
                                    <select class="form-control select2" name="fixed_assets_acc_id" id="fixed_assets_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->fixed_assets_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('invoice_items_count', __('accounting::lang.invoice_items_count') . ':') !!}
                                    <input class="form-group" type="number" name="invoice_items_count" value="{{$mapping->invoice_items_count}}" id="invoice_items_count">
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('currency', __('accounting::lang.currency') . ':') !!}
                                    <select class="form-control select2" name="currency" id="currency">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->currency == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

        <div class="card">
            <div class="card-header">
                <h3>@lang('accounting::lang.store')</h3>

            </div>
            <div class="card-body">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('stock_acc_id', __('accounting::lang.stock_acc_id') . ':') !!}
                                    <select class="form-control select2" name="stock_acc_id" id="stock_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->stock_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('damaged_stock_acc_id', __('accounting::lang.damaged_stock_acc_id') . ':') !!}
                                    <select class="form-control select2" name="damaged_stock_acc_id" id="damaged_stock_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->damaged_stock_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('ingred_store_acc_id', __('accounting::lang.ingred_store_acc_id') . ':') !!}
                                    <select class="form-control select2" name="ingred_store_acc_id" id="ingred_store_acc_id">
                                        <option value="">@lang('messages.please_select')</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if ($mapping->ingred_store_acc_id == $account->id) selected @endif>
                                                {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
            </div>
        </div> --}}

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">@lang('messages.save')</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
        </div>


        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection

@section('javascript')
    <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            __page_leave_confirmation('#product_add_form');
        });
    </script>
@endsection
