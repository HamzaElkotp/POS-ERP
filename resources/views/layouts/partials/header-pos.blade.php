<!-- default value -->
@php
    $go_back_url = action([\App\Http\Controllers\SellPosController::class, 'index']);
    $transaction_sub_type = '';
    $view_suspended_sell_url = action([\App\Http\Controllers\SellController::class, 'index']) . '?suspended=1';
    $pos_redirect_url = action([\App\Http\Controllers\SellPosController::class, 'create']);
@endphp

@if (!empty($pos_module_data))
    @foreach ($pos_module_data as $key => $value)
        @php
            if (!empty($value['go_back_url'])) {
                $go_back_url = $value['go_back_url'];
            }

            if (!empty($value['transaction_sub_type'])) {
                $transaction_sub_type = $value['transaction_sub_type'];
                $view_suspended_sell_url .= '&transaction_sub_type=' . $transaction_sub_type;
                $pos_redirect_url .= '?sub_type=' . $transaction_sub_type;
            }
        @endphp
    @endforeach
@endif
<input type="hidden" name="transaction_sub_type" id="transaction_sub_type" value="{{ $transaction_sub_type }}">
@inject('request', 'Illuminate\Http\Request')
<div class="col-md-12 no-print pos-header">
    <input type="hidden" id="pos_redirect_url" value="{{ $pos_redirect_url }}">
    <div class="row mx-0 px-3">

        <div class="col-md-4 mobile-paddx-0">
            <div class="d-flex flex-row justify-content-evenly align-items-center">
                <div class="p-2 flex-fill">
                    <div class="d-flex align-items-center">
                        <p class="my-0 fw-600 fs-16">@lang('sale.location'): &nbsp;</p>

                        @if (empty($transaction->location_id))
                            @if (count($business_locations) > 1)
                                <div style="width: calc(100% - 120px);" class="my-0 width100minus">
                                    {!! Form::select(
                                        'select_location_id',
                                        $business_locations,
                                        $default_location->id ?? null,
                                        ['class' => 'form-select form-select', 'id' => 'select_location_id', 'required', 'autofocus'],
                                        $bl_attributes,
                                    ) !!}
                                </div>
                            @else
                                {{ $default_location->name }}
                            @endif
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-5 mobile-paddx-0">
            <div class="p-2 d-flex justify-content-center align-items-center buttonscroll">
                @if (!empty($pos_settings['inline_service_staff']))
                    <button type="button" id="show_service_staff_availability"
                        title="{{ __('lang_v1.service_staff_availability') }}"
                        class="btn cusTheme-dark icon outline mx-2 pull-right" data-container=".view_modal"
                        data-href="{{ action([\App\Http\Controllers\SellPosController::class, 'showServiceStaffAvailibility']) }}">
                        <i class="fa fa-users fa-lg"></i>
                    </button>
                @endif

                @can('close_cash_register')
                    <button type="button" id="close_register" title="{{ __('cash_register.close_register') }}"
                        class="btn cusTheme-dark icon outline mx-2 btn-modal pull-right"
                        data-container=".close_register_modal"
                        data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getCloseRegister']) }}">
                        <strong><i class="fa fa-window-close fa-lg"></i></strong>
                    </button>
                @endcan

                @can('view_cash_register')
                    <button type="button" id="register_details" title="{{ __('cash_register.register_details') }}"
                        class="btn btn-modal pull-right cusTheme-dark icon outline mx-2"
                        data-container=".register_details_modal"
                        data-href="{{ action([\App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails']) }}">
                        <strong><i class="fa fa-briefcase fa-lg" aria-hidden="true"></i></strong>
                    </button>
                @endcan

                <button title="@lang('lang_v1.calculator')" id="btnCalculator" type="button"
                    class="btn cusTheme-dark icon outline mx-2 popover-default" data-toggle="popover"
                    data-trigger="click" data-content='@include('layouts.partials.calculator')' data-html="true"
                    data-placement="bottom">
                    <i class="fa-solid fa-calculator"></i>
                </button>

                <button title="@lang('lang_v1.sell_return')" id="return_sale" type="button"
                    class="btn cusTheme-dark icon outline mx-2 popover-default" data-toggle="popover"
                    data-trigger="click" data-content='<div class="m-8"><input type="text" class="form-control" placeholder="@lang('sale.invoice_no')" id="send_for_sell_return_invoice_no"></div><div class="w-100 text-center"><button type="button" class="btn btn-danger" id="send_for_sell_return">@lang('lang_v1.send')</button></div>'
                    data-html="true" data-placement="bottom">
                    <strong><i class="fas fa-undo fa-lg"></i></strong>
                </button>

                <button type="button" title="{{ __('lang_v1.full_screen') }}"
                    class="btn cusTheme-dark icon outline mx-2 icon outline pull-right" id="full_screen">
                    <i class="fa-solid fa-expand"></i>
                </button>

                <button type="button" id="view_suspended_sales" title="{{ __('lang_v1.view_suspended_sales') }}"
                    class="btn cusTheme-dark icon outline mx-2 btn-modal pull-right" data-container=".view_modal"
                    data-href="{{ $view_suspended_sell_url }}">
                    <strong><i class="fa-solid fa-boxes-stacked"></i></strong>
                </button>

                @if (empty($pos_settings['hide_product_suggestion']) && isMobile())
                    <button type="button" title="{{ __('lang_v1.view_products') }}" data-placement="bottom"
                        class="btn btn-success btn-flat m-6 btn-xs m-5 btn-modal pull-right" data-toggle="modal"
                        data-target="#mobile_product_suggestion_modal">
                        <i class="fa fa-cubes fa-lg"></i>
                    </button>
                @endif
                @php
                    $business = App\Business::find(auth()->user()->business_id);
                    $mod = $business->subscriptions;
                    foreach ($mod as $item) {
                        $package_modules = $item->package['custom_permissions'];
                    }

                    $enabled_modules1 = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];

                    $enabled_modules = array_merge($enabled_modules1, array_keys($package_modules));
                    // dd($enabled_modules);

                    // dd($enabled_modules);
                @endphp
                @if (in_array('repair_module', $enabled_modules) && (Module::has('Repair') && $transaction_sub_type != 'repair'))
                    @include('repair::layouts.partials.pos_header')
                @endif

                @if (in_array('pos_sale', $enabled_modules) && !empty($transaction_sub_type))
                    @can('sell.create')
                        <a href="{{ action([\App\Http\Controllers\SellPosController::class, 'create']) }}"
                            title="@lang('sale.pos_sale')" class="btn btn-success btn-flat m-6 btn-xs m-5 pull-right">
                            <i class="fa fa-th-large"></i> &nbsp; @lang('sale.pos_sale')
                        </a>
                    @endcan
                @endif
                @can('expense.add')
                    <button type="button" title="{{ __('expense.add_expense') }}" data-placement="bottom"
                        class="btn cusTheme-dark pull-right mx-2" id="add_expense">
                        <i class="fa-solid fa-file-circle-plus"></i> <span>@lang('expense.add_expense')</span>
                    </button>
                @endcan

            </div>
        </div>

        <div class="col-md-3 mobile-paddx-0">
            <div class="p-2 d-flex justify-content-end align-items-center backdate">
                <div class="p-2 d-flex justify-content-evenly align-items-center">
                    @if (!empty($transaction->location_id))
                        {{ $transaction->location->name }}
                    @endif &nbsp; <span class="curr_datetime mobile-paddx-0">{{ @format_datetime('now') }}</span>
                    <i class="fa fa-keyboard hover-q text-cusTheme fs-2 mx-3" aria-hidden="true" data-container="body"
                        data-toggle="popover" data-placement="bottom" data-content="@include('sale_pos.partials.keyboard_shortcuts_details')"
                        data-html="true" data-trigger="hover" data-original-title="" title=""></i>
                </div>

                <div class="p-2 d-flex justify-content-evenly align-items-center">
                    <a href="{{ $go_back_url }}" title="{{ __('lang_v1.go_back') }}"
                        class="link cusTheme backLink pull-left">
                        <span>{{ __('lang_v1.go_back') }}</span>
                        <i class="fa-solid fa-caret-left ltrRotate180"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>