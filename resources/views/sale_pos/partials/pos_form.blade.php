<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="input-group">
                <input type="hidden" id="default_customer_id" value="{{ $walk_in_customer['id'] ?? '' }}">
                <input type="hidden" id="default_customer_name" value="{{ $walk_in_customer['name'] ?? '' }}">
                <input type="hidden" id="default_customer_balance" value="{{ $walk_in_customer['balance'] ?? '' }}">
                <input type="hidden" id="default_customer_address"
                    value="{{ $walk_in_customer['shipping_address'] ?? '' }}">
                @if (
                    !empty($walk_in_customer['price_calculation_type']) &&
                        $walk_in_customer['price_calculation_type'] == 'selling_price_group')
                    <input type="hidden" id="default_selling_price_group"
                        value="{{ $walk_in_customer['selling_price_group_id'] ?? '' }}">
                @endif


                <div class="col-md-12 px-0">
                    <div class="py-4 px-4 cusBoxAnlys selectin">
                        <div class="boxTitle d-flex">
                            <div class="icon_Boxer">
                                <i class="fa fa-user fsz-35 text-white"></i>
                            </div>
                            <div class="text-center textContenter">
                                {!! Form::select('contact_id', [], null, [
                                    'class' => 'form-control mousetrap',
                                    'id' => 'customer_id',
                                    'placeholder' => 'Enter Customer name / phone',
                                    'required',
                                ]) !!}
                                <span class="input-group-btn mt-4">
                                    <button type="button"
                                        class="btn btn-flat add_new_customer cusTheme-dark icon outline" data-name=""
                                        @if (!auth()->user()->can('customer.create')) disabled @endif><i
                                            class="fa fa-plus-circle fa-lg"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <small class="text-danger hide contact_due_text"><strong>@lang('account.customer_due'):</strong> <span></span></small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group custom-input-group">
            <div class="input-group">
                {{-- <div class="input-group-btn">
					<button type="button" class="btn btn-default bg-white btn-flat custom-search-btn" data-toggle="modal" data-target="#configure_search_modal" title="{{__('lang_v1.configure_product_search')}}">
						<i class="fas fa-search-plus"></i>
					</button>
				</div> --}}

                <div class="col-md-12 px-0">
                    <div class="py-4 px-4 cusBoxAnlys selectin">
                        <div class="boxTitle d-flex">
                            <div class="icon_Boxer">
                                <i class="fa-solid fa-box fsz-35 text-white"></i>
                            </div>
                            <div class="text-center textContenter">
                                {!! Form::text('search_product', null, [
                                    'class' => 'form-control mousetrap custom-search-input',
                                    'id' => 'search_product',
                                    'placeholder' => __('lang_v1.search_product_placeholder'),
                                    'disabled' => is_null($default_location) ? true : false,
                                    'autofocus' => is_null($default_location) ? false : true,
                                ]) !!}
                                <span class="input-group-btn custom-btn-group">
                                    <!-- Show button for weighing scale modal -->
                                    @if (isset($pos_settings['enable_weighing_scale']) && $pos_settings['enable_weighing_scale'] == 1)
                                        <button type="button"
                                            class="btn btn-default btn-flat custom-weighing-scale-btn cusTheme-dark icon outline mx-2 width50"
                                            id="weighing_scale_btn" data-toggle="modal"
                                            data-target="#weighing_scale_modal" title="@lang('lang_v1.weighing_scale')">
                                            <i class="fa fa-digital-tachograph fa-lg"></i>
                                        </button>
                                    @endif
                                    <button type="button"
                                        class="btn cusTheme-dark icon outline btn-flat custom-pos-add-product-btn width50"
                                        data-href="{{ action([\App\Http\Controllers\ProductController::class, 'quickAdd']) }}"
                                        data-container=".quick_add_product_modal">
                                        <i class="fa fa-plus-circle fa-lg"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    @if (!empty($pos_settings['show_invoice_layout']))
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::select('invoice_layout_id', $invoice_layouts, $default_location->invoice_layout_id, [
                    'class' => 'form-control select2',
                    'placeholder' => __('lang_v1.select_invoice_layout'),
                    'id' => 'invoice_layout_id',
                ]) !!}
            </div>
        </div>
    @endif
    <input type="hidden" name="pay_term_number" id="pay_term_number"
        value="{{ $walk_in_customer['pay_term_number'] ?? '' }}">
    <input type="hidden" name="pay_term_type" id="pay_term_type"
        value="{{ $walk_in_customer['pay_term_type'] ?? '' }}">

    @if (!empty($commission_agent))
        @php
            $is_commission_agent_required = !empty($pos_settings['is_commission_agent_required']);
        @endphp
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::select('commission_agent', $commission_agent, null, [
                    'class' => 'form-control select2',
                    'placeholder' => __('lang_v1.commission_agent'),
                    'id' => 'commission_agent',
                    'required' => $is_commission_agent_required,
                ]) !!}
            </div>
        </div>
    @endif
    @if (!empty($pos_settings['enable_transaction_date']))
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                    {!! Form::text('transaction_date', $default_datetime, [
                        'class' => 'form-control',
                        'readonly',
                        'required',
                        'id' => 'transaction_date',
                    ]) !!}
                </div>
            </div>
        </div>
    @endif
    @if (config('constants.enable_sell_in_diff_currency') == true)
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-exchange-alt"></i>
                    </span>
                    {!! Form::text('exchange_rate', config('constants.currency_exchange_rate'), [
                        'class' => 'form-control input-sm input_number',
                        'placeholder' => __('lang_v1.currency_exchange_rate'),
                        'id' => 'exchange_rate',
                    ]) !!}
                </div>
            </div>
        </div>
    @endif
    @if (!empty($price_groups) && count($price_groups) > 1)
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fas fa-money-bill-alt"></i>
                    </span>
                    @php
                        reset($price_groups);
                        $selected_price_group = !empty($default_price_group_id) && array_key_exists($default_price_group_id, $price_groups) ? $default_price_group_id : null;
                    @endphp
                    {!! Form::hidden('hidden_price_group', key($price_groups), ['id' => 'hidden_price_group']) !!}
                    {!! Form::select('price_group', $price_groups, $selected_price_group, [
                        'class' => 'form-control select2',
                        'id' => 'price_group',
                    ]) !!}
                    <span class="input-group-addon">
                        @show_tooltip(__('lang_v1.price_group_help_text'))
                    </span>
                </div>
            </div>
        </div>
    @else
        @php
            reset($price_groups);
        @endphp
        {!! Form::hidden('price_group', key($price_groups), ['id' => 'price_group']) !!}
    @endif
    @if (!empty($default_price_group_id))
        {!! Form::hidden('default_price_group', $default_price_group_id, ['id' => 'default_price_group']) !!}
    @endif

    @if (in_array('types_of_service', $enabled_modules) && !empty($types_of_service))
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="fa fa-external-link-square-alt text-primary service_modal_btn"></i>
                    </span>
                    {!! Form::select('types_of_service_id', $types_of_service, null, [
                        'class' => 'form-control',
                        'id' => 'types_of_service_id',
                        'style' => 'width: 100%;',
                        'placeholder' => __('lang_v1.select_types_of_service'),
                    ]) !!}

                    {!! Form::hidden('types_of_service_price_group', null, ['id' => 'types_of_service_price_group']) !!}

                    <span class="input-group-addon">
                        @show_tooltip(__('lang_v1.types_of_service_help'))
                    </span>
                </div>
                <small>
                    <p class="help-block hide" id="price_group_text">@lang('lang_v1.price_group'): <span></span></p>
                </small>
            </div>
        </div>
        <div class="modal fade types_of_service_modal" tabindex="-1" role="dialog"
            aria-labelledby="gridSystemModalLabel"></div>
    @endif

    @if (!empty($pos_settings['show_invoice_scheme']))
        @php
            $invoice_scheme_id = $default_invoice_schemes->id;
            if (!empty($default_location->invoice_scheme_id)) {
                $invoice_scheme_id = $default_location->invoice_scheme_id;
            }
        @endphp
        <div class="col-md-4 col-sm-6">
            <div class="form-group">
                {!! Form::select('invoice_scheme_id', $invoice_schemes, $invoice_scheme_id, [
                    'class' => 'form-control',
                    'placeholder' => __('lang_v1.select_invoice_scheme'),
                    'id' => 'invoice_scheme_id',
                ]) !!}
            </div>
        </div>
    @endif
    @if (in_array('subscription', $enabled_modules))
        <div class="col-md-4 col-sm-6">
            <label>
                {!! Form::checkbox('is_recurring', 1, false, ['class' => 'input-icheck', 'id' => 'is_recurring']) !!} @lang('lang_v1.subscribe')?
            </label><button type="button" data-toggle="modal" data-target="#recurringInvoiceModal"
                class="btn btn-link"><i
                    class="fa fa-external-link-square-alt"></i></button>@show_tooltip(__('lang_v1.recurring_invoice_help'))
        </div>
    @endif
    <!-- Call restaurant module if defined -->
    @if (in_array('tables', $enabled_modules) || in_array('service_staff', $enabled_modules))
        <div class="clearfix"></div>
        <span id="restaurant_module_span">
            <div class="col-md-3"></div>
        </span>
    @endif

</div>
<!-- include module fields -->
@if (!empty($pos_module_data))
    @foreach ($pos_module_data as $key => $value)
        @if (!empty($value['view_path']))
            @includeIf($value['view_path'], ['view_data' => $value['view_data']])
        @endif
    @endforeach
@endif
<div class="row">

    <div class="form-check form-switch d-flex justify-content-between" style="width: 200px !important;">
        <label class="form-check-label" for="lens" style="font-weight: 500">Show</label>
        <input class="form-check-input mx-4" type="checkbox" role="switch" id="lens" checked=true>
        <label class="form-check-label" for="lens" style="font-weight: 500">Hide lens</label>
    </div>

    <div class="col-sm-12 pos_product_div">
        <input type="hidden" name="sell_price_tax" id="sell_price_tax"
            value="{{ $business_details->sell_price_tax }}">

        <!-- Keeps count of product rows -->
        <input type="hidden" id="product_row_count" value="0">
        @php
            $hide_tax = '';
            if (session()->get('business.enable_inline_tax') == 0) {
                $hide_tax = 'hide';
            }
        @endphp
        <table class="table table-condensed table-bordered table-striped table-responsive" id="pos_table">
            <thead>
                <tr>
                    <th
                        class="fs-4 fw-500 tex-center tb-col-200 @if (!empty($pos_settings['inline_service_staff'])) col-md-3 @else col-md-4 @endif">
                        <i class="fa-solid fa-box text-cusTheme1"></i> @lang('sale.product')
                        @show_tooltip(__('lang_v1.tooltip_sell_product_column'))
                    </th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-150">
                        <i class="fa-solid fa-boxes-stacked text-cusTheme1"></i> @lang('sale.qty')
                    </th>
                    @if (!empty($pos_settings['inline_service_staff']))
                        <th class="fs-4 fw-500 text-center col-md-2 tb-col-150">
                            <i class="fa-solid fa-people-group text-cusTheme1"></i> @lang('restaurant.service_staff')
                        </th>
                    @endif
                    <th class="fs-4 fw-500 text-center col-md-3 tb-col-200 {{ $hide_tax }}">
                        <i class="fa-solid fa-sack-dollar text-cusTheme1"></i> @lang('sale.price_inc_tax')
                    </th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-150">
                        <i class="fa-solid fa-dollar-sign text-cusTheme1"></i> @lang('sale.subtotal')
                    </th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>R-D-Sph</th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>R-D-Cyl</th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>R-D-Axi</th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>R-Rd-Cyl</th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>R-Rd-Axi</th>

                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>L-D-Sph</th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>L-D-Cyl</th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>L-D-Axi</th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>L-Rd-Cyl</th>
                    <th class="fs-4 fw-500 text-center col-md-2 tb-col-100" col_to_hide>>L-Rd-Axi</th>

                    <th class="text-center col-md-2 tb-col-50"><i class="fas fa-times fs-3" aria-hidden="true"></i></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>


<script>
    let lens = document.getElementById("lens");
    let cols_to_hide = document.querySelectorAll("[col_to_hide]");
    lens.addEventListener("change", ()=>{
        cols_to_hide.forEach((ele)=>{
            ele.classList.toggle("hide")
        })
    })
</script>