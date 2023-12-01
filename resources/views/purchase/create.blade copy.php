@extends('layouts.app')
@section('title', __('purchase.add_purchase'))

@section('content')

    @php
        $custom_labels = json_decode(session('business.custom_labels'), true);
    @endphp
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('purchase.add_purchase') <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true" data-container="body"
                data-toggle="popover" data-placement="bottom" data-content="@include('purchase.partials.keyboard_shortcuts_details')" data-html="true"
                data-trigger="hover" data-original-title="" title=""></i></h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Page level currency setting -->
        <input type="hidden" id="p_code" value="{{ $currency_details->code }}">
        <input type="hidden" id="p_symbol" value="{{ $currency_details->symbol }}">
        <input type="hidden" id="p_thousand" value="{{ $currency_details->thousand_separator }}">
        <input type="hidden" id="p_decimal" value="{{ $currency_details->decimal_separator }}">

        @include('layouts.partials.error')

        {!! Form::open([
            'url' => action([\App\Http\Controllers\PurchaseController::class, 'store']),
            'method' => 'post',
            'id' => 'add_purchase_form',
            'files' => true,
        ]) !!}
        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="@if (!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
                    <div class="form-group">
                        {!! Form::label('supplier_id', __('purchase.supplier') . ':*') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </span>
                            {!! Form::select('contact_id', [], null, [
                                'class' => 'form-control',
                                'placeholder' => __('messages.please_select'),
                                'required',
                                'id' => 'supplier_id',
                            ]) !!}
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat add_new_supplier"
                                    data-name=""><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                            </span>
                        </div>
                    </div>
                    <strong>
                        @lang('business.address'):
                    </strong>
                    <div id="supplier_address_div"></div>
                </div>
                <div class="@if (!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
                    <div class="form-group">
                        {!! Form::label('ref_no', __('purchase.ref_no') . ':') !!}
                        @show_tooltip(__('lang_v1.leave_empty_to_autogenerate'))
                        {!! Form::text('ref_no', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="@if (!empty($default_purchase_status)) col-sm-4 @else col-sm-3 @endif">
                    <div class="form-group">
                        {!! Form::label('transaction_date', __('purchase.purchase_date') . ':*') !!}
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            {!! Form::text('transaction_date', @format_datetime('now'), ['class' => 'form-control', 'readonly', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 @if (!empty($default_purchase_status)) hide @endif">
                    <div class="form-group">
                        {!! Form::label('status', __('purchase.purchase_status') . ':*') !!} @show_tooltip(__('tooltip.order_status'))
                        {!! Form::select('status', $orderStatuses, $default_purchase_status, [
                            'class' => 'form-control select2',
                            'placeholder' => __('messages.please_select'),
                            'required',
                        ]) !!}
                    </div>
                </div>
                @if (count($business_locations) == 1)
                    @php
                        $default_location = current(array_keys($business_locations->toArray()));
                        $search_disable = false;
                    @endphp
                @else
                    @php$default_location = null;
                                                                                                                                                                                                                                                                        $search_disable = true;
                                                                                                                                                                                                                            @endphp ?> ?> ?> ?> ?> ?> ?> ?> ?> ?>
                @endif
                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('location_id', __('purchase.business_location') . ':*') !!}
                        @show_tooltip(__('tooltip.purchase_location'))
                        {!! Form::select(
                            'location_id',
                            $business_locations,
                            $default_location,
                            ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required'],
                            $bl_attributes,
                        ) !!}
                    </div>
                </div>

                <!-- Currency Exchange Rate -->
                <div class="col-sm-3 @if (!$currency_details->purchase_in_diff_currency) hide @endif">
                    <div class="form-group">
                        {!! Form::label('exchange_rate', __('purchase.p_exchange_rate') . ':*') !!}
                        @show_tooltip(__('tooltip.currency_exchange_factor'))
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            {!! Form::number('exchange_rate', $currency_details->p_exchange_rate, [
                                'class' => 'form-control',
                                'required',
                                'step' => 0.001,
                            ]) !!}
                        </div>
                        <span class="help-block text-danger">
                            @lang('purchase.diff_purchase_currency_help', ['currency' => $currency_details->name])
                        </span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <div class="multi-input">
                            {!! Form::label('pay_term_number', __('contact.pay_term') . ':') !!} @show_tooltip(__('tooltip.pay_term'))
                            <br />
                            {!! Form::number('pay_term_number', null, [
                                'class' => 'form-control width-40 pull-left',
                                'placeholder' => __('contact.pay_term'),
                            ]) !!}

                            {!! Form::select('pay_term_type', ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], null, [
                                'class' => 'form-control width-60 pull-left',
                                'placeholder' => __('messages.please_select'),
                                'id' => 'pay_term_type',
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        {!! Form::label('document', __('purchase.attach_document') . ':') !!}
                        {!! Form::file('document', [
                            'id' => 'upload_document',
                            'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types'))),
                        ]) !!}
                        <p class="help-block">
                            @lang('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000])
                            @includeIf('components.document_help_text')
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $custom_field_1_label = !empty($custom_labels['purchase']['custom_field_1']) ? $custom_labels['purchase']['custom_field_1'] : '';

                    $is_custom_field_1_required = !empty($custom_labels['purchase']['is_custom_field_1_required']) && $custom_labels['purchase']['is_custom_field_1_required'] == 1 ? true : false;

                    $custom_field_2_label = !empty($custom_labels['purchase']['custom_field_2']) ? $custom_labels['purchase']['custom_field_2'] : '';

                    $is_custom_field_2_required = !empty($custom_labels['purchase']['is_custom_field_2_required']) && $custom_labels['purchase']['is_custom_field_2_required'] == 1 ? true : false;

                    $custom_field_3_label = !empty($custom_labels['purchase']['custom_field_3']) ? $custom_labels['purchase']['custom_field_3'] : '';

                    $is_custom_field_3_required = !empty($custom_labels['purchase']['is_custom_field_3_required']) && $custom_labels['purchase']['is_custom_field_3_required'] == 1 ? true : false;

                    $custom_field_4_label = !empty($custom_labels['purchase']['custom_field_4']) ? $custom_labels['purchase']['custom_field_4'] : '';

                    $is_custom_field_4_required = !empty($custom_labels['purchase']['is_custom_field_4_required']) && $custom_labels['purchase']['is_custom_field_4_required'] == 1 ? true : false;
                @endphp
                @if (!empty($custom_field_1_label))
                    @php
                        $label_1 = $custom_field_1_label . ':';
                        if ($is_custom_field_1_required) {
                            $label_1 .= '*';
                        }
                    @endphp

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('custom_field_1', $label_1) !!}
                            {!! Form::text('custom_field_1', null, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_1_label,
                                'required' => $is_custom_field_1_required,
                            ]) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($custom_field_2_label))
                    @php
                        $label_2 = $custom_field_2_label . ':';
                        if ($is_custom_field_2_required) {
                            $label_2 .= '*';
                        }
                    @endphp

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('custom_field_2', $label_2) !!}
                            {!! Form::text('custom_field_2', null, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_2_label,
                                'required' => $is_custom_field_2_required,
                            ]) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($custom_field_3_label))
                    @php
                        $label_3 = $custom_field_3_label . ':';
                        if ($is_custom_field_3_required) {
                            $label_3 .= '*';
                        }
                    @endphp

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('custom_field_3', $label_3) !!}
                            {!! Form::text('custom_field_3', null, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_3_label,
                                'required' => $is_custom_field_3_required,
                            ]) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($custom_field_4_label))
                    @php
                        $label_4 = $custom_field_4_label . ':';
                        if ($is_custom_field_4_required) {
                            $label_4 .= '*';
                        }
                    @endphp

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('custom_field_4', $label_4) !!}
                            {!! Form::text('custom_field_4', null, [
                                'class' => 'form-control',
                                'placeholder' => $custom_field_4_label,
                                'required' => $is_custom_field_4_required,
                            ]) !!}
                        </div>
                    </div>
                @endif
            </div>
            @if (!empty($common_settings['enable_purchase_order']))
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('purchase_order_ids', __('lang_v1.purchase_order') . ':') !!}
                            {!! Form::select('purchase_order_ids[]', [], null, [
                                'class' => 'form-control select2',
                                'multiple',
                                'id' => 'purchase_order_ids',
                            ]) !!}
                        </div>
                    </div>
                </div>
            @endif
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-sm-2 text-center">
                    <button type="button" class="btn btn-primary btn-flat" data-toggle="modal"
                        data-target="#import_purchase_products_modal">@lang('product.import_products')</button>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                            {!! Form::text('search_product', null, [
                                'class' => 'form-control mousetrap',
                                'id' => 'search_product',
                                'placeholder' => __('lang_v1.search_product_placeholder'),
                                'disabled' => $search_disable,
                            ]) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <button tabindex="-1" type="button"
                            class="btn btn-link btn-modal"data-href="{{ action([\App\Http\Controllers\ProductController::class, 'quickAdd']) }}"
                            data-container=".quick_add_product_modal"><i class="fa fa-plus"></i> @lang('product.add_new_product') </button>
                    </div>
                </div>
            </div>
            @php
                $hide_tax = '';
                if (session()->get('business.enable_inline_tax') == 0) {
                    $hide_tax = 'hide';
                }
            @endphp
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered table-th-green text-center table-striped"
                            id="purchase_entry_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('product.product_name')</th>
                                    <th>@lang('purchase.purchase_quantity')</th>
                                    <th>@lang('lang_v1.unit_cost_before_discount')</th>
                                    <th>@lang('lang_v1.discount_percent')</th>
                                    <th>@lang('purchase.unit_cost_before_tax')</th>
                                    <th class="{{ $hide_tax }}">@lang('purchase.subtotal_before_tax')</th>
                                    <th class="{{ $hide_tax }}">@lang('purchase.product_tax')</th>
                                    <th class="{{ $hide_tax }}">@lang('purchase.net_cost')</th>
                                    <th>@lang('purchase.line_total')</th>
                                    <th class="@if (!session('business.enable_editing_product_from_purchase')) hide @endif">
                                        @lang('lang_v1.profit_margin')
                                    </th>
                                    <th>
                                        @lang('purchase.unit_selling_price')
                                        <small>(@lang('product.inc_of_tax'))</small>
                                    </th>
                                    @if (session('business.enable_lot_number'))
                                        <th>
                                            @lang('lang_v1.lot_number')
                                        </th>
                                    @endif
                                    @if (session('business.enable_product_expiry'))
                                        <th>
                                            @lang('product.mfg_date') / @lang('product.exp_date')
                                        </th>
                                    @endif
                                    <th><i class="fa fa-trash" aria-hidden="true"></i></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <hr />
                    <div class="pull-right col-md-5">
                        <table class="pull-right col-md-12">
                            <tr>
                                <th class="col-md-7 text-right">@lang('lang_v1.total_items'):</th>
                                <td class="col-md-5 text-left">
                                    <span id="total_quantity" class="display_currency" data-currency_symbol="false"></span>
                                </td>
                            </tr>
                            <tr class="hide">
                                <th class="col-md-7 text-right">@lang('purchase.total_before_tax'):</th>
                                <td class="col-md-5 text-left">
                                    <span id="total_st_before_tax" class="display_currency"></span>
                                    <input type="hidden" id="st_before_tax_input" value=0>
                                </td>
                            </tr>
                            <tr>
                                <th class="col-md-7 text-right">@lang('purchase.net_total_amount'):</th>
                                <td class="col-md-5 text-left">
                                    <span id="total_subtotal" class="display_currency"></span>
                                    <!-- This is total before purchase tax-->
                                    <input type="hidden" id="total_subtotal_input" value=0 name="total_before_tax">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <input type="hidden" id="row_count" value="0">
                </div>
            </div>
            @if (in_array('tables', $enabled_modules) || in_array('lens', $enabled_modules))
                <div class="text_container">
                    <button class="btn btn-primary lenss">عرض مواصفات العدسات</button>

                    <div class="card lens">
                        <div class="card-header d-flex">
                            <h2>
                                إضافه الكميات للعدسه
                            </h2>

                        </div>


                        <div class="card-body" dir="ltr">
                            <div class="">
                                <form method="POST" action="{{ route('products.store_quant1', $len[0]['id']) }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-2">

                                        </div>

                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-danger" type="submit">
                                                {{ trans('global.save') }}
                                            </button>
                                        </div>

                                    </div>
                                    <div class="tbl">

                                        <table
                                            class=" table table-responsive table-bordered table-striped table-hover datatable datatable-Len ">
                                            <thead>
                                                <tr>
                                                    {{-- <th></th> --}}
                                                    <th>Sph</th>
                                                    <th>0.00</th>
                                                    {{-- <th>+0.25</th>
                                <th>+0.50</th>
                                <th>+0.75</th>
                                <th>+1.00</th>
                                <th>+1.25</th>
                                <th>+1.50</th>
                                <th>+1.75</th>
                                <th>+2.00</th>
                                <th>+2.25</th>
                                <th>+2.50</th>
                                <th>+2.75</th>
                                <th>+3.00</th>
                                <th>+3.25</th>
                                <th>+3.50</th>
                                <th>+3.75</th>
                                <th>+4.00</th>
                                <th>+4.25</th>
                                <th>+4.50</th>
                                <th>+4.75</th>
                                <th>+5.00</th>
                                <th>+5.25</th>
                                <th>+5.50</th>
                                <th>+5.75</th>
                                <th>+6.00</th> --}}
                                                    <th>-0.25</th>
                                                    <th>-0.50</th>
                                                    <th>-0.75</th>
                                                    <th>-1.00</th>
                                                    <th>-1.25</th>
                                                    <th>-1.50</th>
                                                    <th>-1.75</th>
                                                    <th>-2.00</th>
                                                    <th>-2.25</th>
                                                    <th>-2.50</th>
                                                    <th>-2.75</th>
                                                    <th>-3.00</th>
                                                    <th>-3.25</th>
                                                    <th>-3.50</th>
                                                    <th>-3.75</th>
                                                    <th>-4.00</th>
                                                    <th>-4.25</th>
                                                    <th>-4.50</th>
                                                    <th>-4.75</th>
                                                    <th>-5.00</th>
                                                    <th>-5.25</th>
                                                    <th>-5.50</th>
                                                    <th>-5.75</th>
                                                    <th>-6.00</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @foreach (old('len_lens_diams', $len->len_lens_diams->count() ? $len->len_lens_diams : ['']) as $order_product) --}}

                                                @foreach ($len[0]['len_lenses_diams'] as $key => $len)
                                                    <tr data-entry-id="{{ $len->id }}" style="font-weight:bold">
                                                        {{-- <td><input readonly name="len_id[]" id="len_id" type="text"
                                            value="{{ old('len_id', $len->len_id) }}"></td> --}}
                                                        <td><input readonly name="sph[]" id="sph" type="text"
                                                                value="{{ old('sph', $len->sph) }}"></td>
                                                        <td><input name="s00[]" id="s00" type="text"
                                                                value="{{ old('s00', $len->s00) }}">
                                                        </td>

                                                        {{-- <td><input name="s25[]" id="s25" type="text" value="{{ old('s25', $len->s25) }}">
                                    </td>
                                    <td><input name="s50[]" id="s50" type="text" value="{{ old('s50', $len->s50) }}">
                                    </td>
                                    <td><input name="s75[]" id="s75" type="text" value="{{ old('s75', $len->s75) }}">
                                    </td>
                                    <td><input name="s100[]" id="s100" type="text" value="{{ old('s100', $len->s100) }}">
                                    </td>
                                    <td><input name="s125[]" id="s125" type="text" value="{{ old('s125', $len->s125) }}">
                                    </td>
                                    <td><input name="s150[]" id="s150" type="text" value="{{ old('s150', $len->s150) }}">
                                    </td>
                                    <td><input name="s175[]" id="s175" type="text" value="{{ old('s175', $len->s175) }}">
                                    </td>
                                    <td><input name="s200[]" id="s200" type="text" value="{{ old('s200', $len->s200) }}">
                                    </td>
                                    <td><input name="s225[]" id="s225" type="text" value="{{ old('s225', $len->s225) }}">
                                    </td>
                                    <td><input name="s250[]" id="s250" type="text" value="{{ old('s250', $len->s250) }}">
                                    </td>
                                    <td><input name="s275[]" id="s275" type="text" value="{{ old('s275', $len->s275) }}">
                                    </td>
                                    <td><input name="s300[]" id="s300" type="text" value="{{ old('s300', $len->s300) }}">
                                    </td>
                                    <td><input name="s325[]" id="s325" type="text" value="{{ old('s325', $len->s325) }}">
                                    </td>
                                    <td><input name="s350[]" id="s350" type="text" value="{{ old('s350', $len->s350) }}">
                                    </td>
                                    <td><input name="s375[]" id="s375" type="text" value="{{ old('s375', $len->s375) }}">
                                    </td>
                                    <td><input name="s400[]" id="s400" type="text" value="{{ old('s400', $len->s400) }}">
                                    </td>
                                    <td><input name="s425[]" id="s425" type="text" value="{{ old('s425', $len->s425) }}">
                                    </td>
                                    <td><input name="s450[]" id="s450" type="text" value="{{ old('s450', $len->s450) }}">
                                    </td>
                                    <td><input name="s475[]" id="s475" type="text" value="{{ old('s475', $len->s475) }}">
                                    </td>
                                    <td><input name="s500[]" id="s500" type="text" value="{{ old('s500', $len->s500) }}">
                                    </td>
                                    <td><input name="s525[]" id="s525" type="text" value="{{ old('s525', $len->s525) }}">
                                    </td>
                                    <td><input name="s550[]" id="s550" type="text" value="{{ old('s550', $len->s550) }}">
                                    </td>
                                    <td><input name="s575[]" id="s575" type="text" value="{{ old('s575', $len->s575) }}">
                                    </td>
                                    <td><input name="s600[]" id="s600" type="text" value="{{ old('s600', $len->s600) }}">
                                    </td> --}}
                                                        <td><input name="_s25[]" id="_s25" type="text"
                                                                value="{{ old('_s25', $len->_s25) }}">
                                                        </td>
                                                        <td><input name="_s50[]" id="_s50" type="text"
                                                                value="{{ old('_s50', $len->_s50) }}">
                                                        </td>
                                                        <td><input name="_s75[]" id="_s75" type="text"
                                                                value="{{ old('_s75', $len->_s75) }}">
                                                        </td>
                                                        <td><input name="_s100[]" id="_s100" type="text"
                                                                value="{{ old('_s100', $len->_s100) }}"></td>
                                                        <td><input name="_s125[]" id="_s125" type="text"
                                                                value="{{ old('_s125', $len->_s125) }}"></td>
                                                        <td><input name="_s150[]" id="_s150" type="text"
                                                                value="{{ old('_s150', $len->_s150) }}"></td>
                                                        <td><input name="_s175[]" id="_s175" type="text"
                                                                value="{{ old('_s175', $len->_s175) }}"></td>
                                                        <td><input name="_s200[]" id="_s200" type="text"
                                                                value="{{ old('_s200', $len->_s200) }}"></td>
                                                        <td><input name="_s225[]" id="_s225" type="text"
                                                                value="{{ old('_s225', $len->_s225) }}"></td>
                                                        <td><input name="_s250[]" id="_s250" type="text"
                                                                value="{{ old('_s250', $len->_s250) }}"></td>
                                                        <td><input name="_s275[]" id="_s275" type="text"
                                                                value="{{ old('_s275', $len->_s275) }}"></td>
                                                        <td><input name="_s300[]" id="_s300" type="text"
                                                                value="{{ old('_s300', $len->_s300) }}"></td>
                                                        <td><input name="_s325[]" id="_s325" type="text"
                                                                value="{{ old('_s325', $len->_s325) }}"></td>
                                                        <td><input name="_s350[]" id="_s350" type="text"
                                                                value="{{ old('_s350', $len->_s350) }}"></td>
                                                        <td><input name="_s375[]" id="_s375" type="text"
                                                                value="{{ old('_s375', $len->_s375) }}"></td>
                                                        <td><input name="_s400[]" id="_s400" type="text"
                                                                value="{{ old('_s400', $len->_s400) }}"></td>
                                                        <td><input name="_s425[]" id="_s425" type="text"
                                                                value="{{ old('_s425', $len->_s425) }}"></td>
                                                        <td><input name="_s450[]" id="_s450" type="text"
                                                                value="{{ old('_s450', $len->_s450) }}"></td>
                                                        <td><input name="_s475[]" id="_s475" type="text"
                                                                value="{{ old('_s475', $len->_s475) }}"></td>
                                                        <td><input name="_s500[]" id="_s500" type="text"
                                                                value="{{ old('_s500', $len->_s500) }}"></td>
                                                        <td><input name="_s525[]" id="_s525" type="text"
                                                                value="{{ old('_s525', $len->_s525) }}"></td>
                                                        <td><input name="_s550[]" id="_s550" type="text"
                                                                value="{{ old('_s550', $len->_s550) }}"></td>
                                                        <td><input name="_s575[]" id="_s575" type="text"
                                                                value="{{ old('_s575', $len->_s575) }}"></td>
                                                        <td><input name="_s600[]" id="_s600" type="text"
                                                                value="{{ old('_s600', $len->_s600) }}"></td>


                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            @endif
        @endcomponent

        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-sm-12">
                    <table class="table">
                        <tr>
                            <td class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('discount_type', __('purchase.discount_type') . ':') !!}
                                    {!! Form::select(
                                        'discount_type',
                                        ['' => __('lang_v1.none'), 'fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')],
                                        '',
                                        ['class' => 'form-control select2'],
                                    ) !!}
                                </div>
                            </td>
                            <td class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('discount_amount', __('purchase.discount_amount') . ':') !!}
                                    {!! Form::text('discount_amount', 0, ['class' => 'form-control input_number', 'required']) !!}
                                </div>
                            </td>
                            <td class="col-md-3">
                                &nbsp;
                            </td>
                            <td class="col-md-3">
                                <b>@lang('purchase.discount'):</b>(-)
                                <span id="discount_calculated_amount" class="display_currency">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    {!! Form::label('tax_id', __('purchase.purchase_tax') . ':') !!}
                                    <select name="tax_id" id="tax_id" class="form-control select2"
                                        placeholder="'Please Select'">
                                        <option value="" data-tax_amount="0" data-tax_type="fixed" selected>
                                            @lang('lang_v1.none')</option>
                                        @foreach ($taxes as $tax)
                                            <option value="{{ $tax->id }}" data-tax_amount="{{ $tax->amount }}"
                                                data-tax_type="{{ $tax->calculation_type }}">{{ $tax->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! Form::hidden('tax_amount', 0, ['id' => 'tax_amount']) !!}
                                </div>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>
                                <b>@lang('purchase.purchase_tax'):</b>(+)
                                <span id="tax_calculated_amount" class="display_currency">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="form-group">
                                    {!! Form::label('additional_notes', __('purchase.additional_notes')) !!}
                                    {!! Form::textarea('additional_notes', null, ['class' => 'form-control', 'rows' => 3]) !!}
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        @endcomponent
        @component('components.widget', ['class' => 'box-primary'])
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('shipping_details', __('purchase.shipping_details') . ':') !!}
                        {!! Form::text('shipping_details', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="form-group">
                        {!! Form::label('shipping_charges', '(+) ' . __('purchase.additional_shipping_charges') . ':') !!}
                        {!! Form::text('shipping_charges', 0, ['class' => 'form-control input_number', 'required']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    $shipping_custom_label_1 = !empty($custom_labels['purchase_shipping']['custom_field_1']) ? $custom_labels['purchase_shipping']['custom_field_1'] : '';

                    $is_shipping_custom_field_1_required = !empty($custom_labels['purchase_shipping']['is_custom_field_1_required']) && $custom_labels['purchase_shipping']['is_custom_field_1_required'] == 1 ? true : false;

                    $shipping_custom_label_2 = !empty($custom_labels['purchase_shipping']['custom_field_2']) ? $custom_labels['purchase_shipping']['custom_field_2'] : '';

                    $is_shipping_custom_field_2_required = !empty($custom_labels['purchase_shipping']['is_custom_field_2_required']) && $custom_labels['purchase_shipping']['is_custom_field_2_required'] == 1 ? true : false;

                    $shipping_custom_label_3 = !empty($custom_labels['purchase_shipping']['custom_field_3']) ? $custom_labels['purchase_shipping']['custom_field_3'] : '';

                    $is_shipping_custom_field_3_required = !empty($custom_labels['purchase_shipping']['is_custom_field_3_required']) && $custom_labels['purchase_shipping']['is_custom_field_3_required'] == 1 ? true : false;

                    $shipping_custom_label_4 = !empty($custom_labels['purchase_shipping']['custom_field_4']) ? $custom_labels['purchase_shipping']['custom_field_4'] : '';

                    $is_shipping_custom_field_4_required = !empty($custom_labels['purchase_shipping']['is_custom_field_4_required']) && $custom_labels['purchase_shipping']['is_custom_field_4_required'] == 1 ? true : false;

                    $shipping_custom_label_5 = !empty($custom_labels['purchase_shipping']['custom_field_5']) ? $custom_labels['purchase_shipping']['custom_field_5'] : '';

                    $is_shipping_custom_field_5_required = !empty($custom_labels['purchase_shipping']['is_custom_field_5_required']) && $custom_labels['purchase_shipping']['is_custom_field_5_required'] == 1 ? true : false;
                @endphp

                @if (!empty($shipping_custom_label_1))
                    @php
                        $label_1 = $shipping_custom_label_1 . ':';
                        if ($is_shipping_custom_field_1_required) {
                            $label_1 .= '*';
                        }
                    @endphp

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_1', $label_1) !!}
                            {!! Form::text('shipping_custom_field_1', null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_1,
                                'required' => $is_shipping_custom_field_1_required,
                            ]) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($shipping_custom_label_2))
                    @php
                        $label_2 = $shipping_custom_label_2 . ':';
                        if ($is_shipping_custom_field_2_required) {
                            $label_2 .= '*';
                        }
                    @endphp

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_2', $label_2) !!}
                            {!! Form::text('shipping_custom_field_2', null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_2,
                                'required' => $is_shipping_custom_field_2_required,
                            ]) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($shipping_custom_label_3))
                    @php
                        $label_3 = $shipping_custom_label_3 . ':';
                        if ($is_shipping_custom_field_3_required) {
                            $label_3 .= '*';
                        }
                    @endphp

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_3', $label_3) !!}
                            {!! Form::text('shipping_custom_field_3', null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_3,
                                'required' => $is_shipping_custom_field_3_required,
                            ]) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($shipping_custom_label_4))
                    @php
                        $label_4 = $shipping_custom_label_4 . ':';
                        if ($is_shipping_custom_field_4_required) {
                            $label_4 .= '*';
                        }
                    @endphp

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_4', $label_4) !!}
                            {!! Form::text('shipping_custom_field_4', null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_4,
                                'required' => $is_shipping_custom_field_4_required,
                            ]) !!}
                        </div>
                    </div>
                @endif
                @if (!empty($shipping_custom_label_5))
                    @php
                        $label_5 = $shipping_custom_label_5 . ':';
                        if ($is_shipping_custom_field_5_required) {
                            $label_5 .= '*';
                        }
                    @endphp

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('shipping_custom_field_5', $label_5) !!}
                            {!! Form::text('shipping_custom_field_5', null, [
                                'class' => 'form-control',
                                'placeholder' => $shipping_custom_label_5,
                                'required' => $is_shipping_custom_field_5_required,
                            ]) !!}
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-primary btn-sm" id="toggle_additional_expense"> <i
                            class="fas fa-plus"></i> @lang('lang_v1.add_additional_expenses') <i class="fas fa-chevron-down"></i></button>
                </div>
                <div class="col-md-8 col-md-offset-4" id="additional_expenses_div" style="display: none;">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>@lang('lang_v1.additional_expense_name')</th>
                                <th>@lang('sale.amount')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {!! Form::text('additional_expense_key_1', null, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_1',
                                    ]) !!}
                                </td>
                                <td>
                                    {!! Form::text('additional_expense_value_1', 0, [
                                        'class' => 'form-control input_number',
                                        'id' => 'additional_expense_value_1',
                                    ]) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::text('additional_expense_key_2', null, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_2',
                                    ]) !!}
                                </td>
                                <td>
                                    {!! Form::text('additional_expense_value_2', 0, [
                                        'class' => 'form-control input_number',
                                        'id' => 'additional_expense_value_2',
                                    ]) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::text('additional_expense_key_3', null, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_3',
                                    ]) !!}
                                </td>
                                <td>
                                    {!! Form::text('additional_expense_value_3', 0, [
                                        'class' => 'form-control input_number',
                                        'id' => 'additional_expense_value_3',
                                    ]) !!}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::text('additional_expense_key_4', null, [
                                        'class' => 'form-control',
                                        'id' => 'additional_expense_key_4',
                                    ]) !!}
                                </td>
                                <td>
                                    {!! Form::text('additional_expense_value_4', 0, [
                                        'class' => 'form-control input_number',
                                        'id' => 'additional_expense_value_4',
                                    ]) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    {!! Form::hidden('final_total', 0, ['id' => 'grand_total_hidden']) !!}
                    <b>@lang('purchase.purchase_total'): </b><span id="grand_total" class="display_currency"
                        data-currency_symbol='true'>0</span>
                </div>
            </div>
        @endcomponent
        @component('components.widget', ['class' => 'box-primary', 'title' => __('purchase.add_payment')])
            <div class="box-body payment_row">
                <div class="row">
                    <div class="col-md-12">
                        <strong>@lang('lang_v1.advance_balance'):</strong> <span id="advance_balance_text">0</span>
                        {!! Form::hidden('advance_balance', null, [
                            'id' => 'advance_balance',
                            'data-error-msg' => __('lang_v1.required_advance_balance_not_available'),
                        ]) !!}
                    </div>
                </div>
                @include('sale_pos.partials.payment_row_form', [
                    'row_index' => 0,
                    'show_date' => true,
                    'show_denomination' => true,
                ])
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="pull-right"><strong>@lang('purchase.payment_due'):</strong> <span id="payment_due">0.00</span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" id="submit_purchase_form"
                            class="btn btn-primary pull-right btn-flat">@lang('messages.save')</button>
                    </div>
                </div>
            </div>
        @endcomponent

        {!! Form::close() !!}
    </section>
    <!-- quick product modal -->
    <div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>
    <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        @include('contact.create', ['quick_add' => true])
    </div>

    @include('purchase.partials.import_purchase_products_modal')
    <!-- /.content -->
@endsection

@section('javascript')
    <script src="{{ asset('js/purchase.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            __page_leave_confirmation('#add_purchase_form');
            $('.paid_on').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            if ($('.payment_types_dropdown').length) {
                $('.payment_types_dropdown').change();
            }
            set_payment_type_dropdown();
            $('select#location_id').change(function() {
                set_payment_type_dropdown();
            });
        });
        $(document).on('change', '.payment_types_dropdown, #location_id', function(e) {
            var default_accounts = $('select#location_id').length ?
                $('select#location_id')
                .find(':selected')
                .data('default_payment_accounts') : [];
            var payment_types_dropdown = $('.payment_types_dropdown');
            var payment_type = payment_types_dropdown.val();
            var payment_row = payment_types_dropdown.closest('.payment_row');
            var row_index = payment_row.find('.payment_row_index').val();

            var account_dropdown = payment_row.find('select#account_' + row_index);
            if (payment_type && payment_type != 'advance') {
                var default_account = default_accounts && default_accounts[payment_type]['account'] ?
                    default_accounts[payment_type]['account'] : '';
                if (account_dropdown.length && default_accounts) {
                    account_dropdown.val(default_account);
                    account_dropdown.change();
                }
            }

            if (payment_type == 'advance') {
                if (account_dropdown) {
                    account_dropdown.prop('disabled', true);
                    account_dropdown.closest('.form-group').addClass('hide');
                }
            } else {
                if (account_dropdown) {
                    account_dropdown.prop('disabled', false);
                    account_dropdown.closest('.form-group').removeClass('hide');
                }
            }
        });

        function set_payment_type_dropdown() {
            var payment_settings = $('#location_id').find(':selected').data('default_payment_accounts');
            payment_settings = payment_settings ? payment_settings : [];
            enabled_payment_types = [];
            for (var key in payment_settings) {
                if (payment_settings[key] && payment_settings[key]['is_enabled']) {
                    enabled_payment_types.push(key);
                }
            }
            if (enabled_payment_types.length) {
                $(".payment_types_dropdown > option").each(function() {
                    //skip if advance
                    if ($(this).val() && $(this).val() != 'advance') {
                        if (enabled_payment_types.indexOf($(this).val()) != -1) {
                            $(this).removeClass('hide');
                        } else {
                            $(this).addClass('hide');
                        }
                    }
                });
            }
        }
    </script>
    <script>
        $('#cyl_n').keyup(function(e) {

            let cyl1 = $('#cyl_n').val() || 0;
            let cyl = 0;
            switch (cyl1) {
                case '0.00':
                    cyl = 's00';

                    break;

                case '0.25':
                    cyl = 's25';
                    break;
                case '0.50':
                    cyl = 's50';
                    break;
                case '0.50':
                    cyl = 's50';
                    break;
                case '0.75':
                    cyl = 's75';
                    break;
                case '1.00':
                    cyl = 's100';
                    break;
                case '1.25':
                    cyl = 's125';
                    break;
                case '1.50':
                    cyl = 's150';
                    break;
                case '1.75':
                    cyl = 's175';
                    break;
                case '2.00':
                    cyl = 's200';
                    break;
                case '2.25':
                    cyl = 's225';
                    break;
                case '2.75':
                    cyl = 's275';
                    break;
                case '3.00':
                    cyl = 's300';
                    break;
                case '3.25':
                    cyl = 's325';
                    break;
                case '3.75':
                    cyl = 's375';
                    break;
                case '4.000':
                    cyl = 's400';
                    break;
                case '4.25':
                    cyl = 's425';
                    break;
                case '4.50':
                    cyl = 's450';
                    break;
                case '4.75':
                    cyl = 's475';
                    break;
                case '5.00':
                    cyl = 's500';
                    break;
                case '5.25':
                    cyl = 's525';
                    break;
                case '5.50':
                    cyl = 's550';
                    break;
                case '5.75':
                    cyl = 's575';
                    break;
                case '6.00':
                    cyl = 's600';
                    break;

                case '-0.25':
                    cyl = '_s25';
                    break;
                case '-0.50':
                    cyl = '_s50';
                    break;
                case '-0.50':
                    cyl = '_s50';
                    break;
                case '-0.75':
                    cyl = '_s75';
                    break;
                case '-1.00':
                    cyl = '_s100';
                    break;
                case '-1.25':
                    cyl = '_s125';
                    break;
                case '-1.50':
                    cyl = '_s150';
                    break;
                case '-1.75':
                    cyl = '_s175';
                    break;
                case '-2.00':
                    cyl = '_s200';
                    break;
                case '-2.25':
                    cyl = '_s225';
                    break;
                case '-2.75':
                    cyl = '_s275';
                    break;
                case '-3.00':
                    cyl = '_s300';
                    break;
                case '-3.25':
                    cyl = '_s325';
                    break;
                case '-3.75':
                    cyl = '_s375';
                    break;
                case '-4.000':
                    cyl = '_s400';
                    break;
                case '-4.25':
                    cyl = '_s425';
                    break;
                case '-4.50':
                    cyl = '_s450';
                    break;
                case '-4.75':
                    cyl = '_s475';
                    break;
                case '-5.00':
                    cyl = '_s500';
                    break;
                case '-5.25':
                    cyl = '_s525';
                    break;
                case '-5.50':
                    cyl = '_s550';
                    break;
                case '-5.75':
                    cyl = '_s575';
                    break;
                case '-6.00':
                    cyl = '_s600';
                    break;

                    // default:
                    //     alert('يجب ادخال Cyl  بشكل صحيح');
            }
            // alert(cyl1);

            $('#cyl_n1').val(cyl);

        });
        $('.lenss ').click(function(e) {
            // var $this =  $('.text_container .lens');
            e.preventDefault();
            if ($('.text_container .lens').hasClass("hidden")) {
                $('.text_container .lens').removeClass("hidden").addClass("visible");

            } else {
                $('.text_container .lens').removeClass("visible").addClass("hidden");
            }
        });
    </script>

    @include('purchase.partials.keyboard_shortcuts')
@endsection
