@extends('layouts.app')
{{-- <link rel="stylesheet" href="{{ asset('assets/backend/css/customTheme.css?v=' . $asset_v) }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/customComponents.css?v=' . $asset_v) }}">
<link href="{{ asset('assets/backend/css/bootstrap.min.css?v=' . $asset_v) }}" rel="stylesheet"> --}}
<style>
    /* In your CSS file */
    .widget-container {
        padding: 20px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background: #09d96e !important;
    }

    .background-none {
        background: none !important;
    }

    body {
        color: #0b2c89 !important;
    }

    .chart-container {

        height: 250px
    }

    .btn-black {
        background-color: #38454a;
    }
</style>
@section('title', __('home.home'))
@section('content')

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content content-custom no-print">
        <section class="row content-header content-header-custom">
            <h1 class="content_h1 text-cusTheme1">{{ __('home.welcome_message', ['name' => Session::get('user.first_name')]) }}</h1>
        </section>

        @if (auth()->user()->can('dashboard.data'))
            @if ($is_admin)
                <div class="row">
                    <div class="col-md-4 col-xs-12 px-0">
                        @if (count($all_locations) > 1)
                            {!! Form::select('dashboard_location', $all_locations, null, [
                                'class' => 'form-control select2',
                                'placeholder' => __('lang_v1.select_location'),
                                'id' => 'dashboard_location',
                            ]) !!}
                        @endif
                    </div>
                    <div class="col-md-8 col-xs-12 px-0">
                        <div class="form-group pull-right will-full-mobile">
                            <div class="input-group">
                                <button type="button" class="btn cusTheme-dark text-white"
                                    id="dashboard_date_filter">
                                    <span>
                                        <i class="fa fa-calendar text-white"></i> {{ __('messages.filter_by_date') }}
                                    </span>
                                    <i class="fa fa-caret-down text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4 mobile-reverse-col">
                    <div class="col-lg-9 col-md-7 col-12 mb-4">
                        <div class="row" id="checkpoint_bottom">
                            
                            <div class="col-lg-6 col-md-12 col-12 mb-6 pl-1 pr-1">
                                <div class="graph-details px-4 py-4">
                                    <div class="px-2 py-2">
                                        <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">Total Sales & Returns</h2>
                                        <hr class="cusColor mt-3">
                                        <p id="chartsell" class="mb-2">
                                            <span class="text-cusTheme1 fsz-15">
                                                <i class="fa-solid fa-boxes-stacked fsz-14"></i> 
                                                <span class="px-2">Sells:</span>
                                            </span>
                                            <span class="total_sell fsz-17 text-cusTheme-dark" data-value="0">£ 540.00</span>
                                        </p>
                                        <p id="chartsellreturn" class="mb-2">
                                            <span class="text-cusTheme1 fsz-15">
                                                <i class="fa-solid fa-boxes-packing fsz-14"></i> 
                                                <span class="px-2">Sell Returns:</span>
                                            </span> 
                                            <span class="total_sell_return fsz-17 text-cusTheme-dark" data-value="0">£ 200.00</span> 
                                        </p>
                                        <canvas id="sellChart" width="300" height="150" class="my-4">Sell Chart Placeholder</canvas>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-12 mb-6 pl-1 pr-1">
                                <div class="graph-details px-4 py-4">
                                    <div class="px-2 py-2">
                                        <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">Total Purchases & Returns</h2>
                                        <hr class="cusColor mt-3">
                                        <div id="chartpurchase">
                                            <span class="text-cusTheme1 fsz-15">
                                                <i class="fa-solid fa-boxes-stacked fsz-14"></i> 
                                                <span class="px-2">Purchase:</span>
                                            </span>
                                            <span class="total_purchase fsz-17 text-cusTheme-dark" data-value="0">£540.00</span>
                                        </div>
                                        <div id="chartpurchasereturn">
                                            <span class="text-cusTheme1 fsz-15">
                                                <i class="fa-solid fa-boxes-packing fsz-14"></i> 
                                                <span class="px-2">Purchase Return:</span>
                                            </span> 
                                            <span class="total_purchase_return fsz-17 text-cusTheme-dark" data-value="0">£ 100.00</span>
                                        </div>
                                        <canvas id="purchaseChart" width="300" height="150" class="my-4">Purchase Chart Placeholder</canvas>
                                    </div>
                                </div>
                            </div>

                            @if (auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))
                                @if (!empty($all_locations))
                                    <!-- sales chart start -->
                                    <div class="col-md-12 mb-6 px-0">
                                        <div class="graph-details px-4 py-4">
                                            <div class="px-2 py-2">
                                                <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">{{ __('home.sells_last_30_days') }}</h2>
                                                <hr class="cusColor mt-3">
                                                {!! $sells_chart_1->container() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($widgets['after_sales_last_30_days']))
                                    @foreach ($widgets['after_sales_last_30_days'] as $widget)
                                        {!! $widget !!}
                                    @endforeach
                                @endif

                                @if (!empty($all_locations))
                                    <div class="col-md-12 px-0">
                                        <div class="graph-details px-4 py-4">
                                            <div class="px-2 py-2">
                                                <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">{{ __('home.sells_current_fy') }}</h2>
                                                <hr class="cusColor mt-3">
                                                {!! $sells_chart_2->container() !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-12 px-0 mb-4">
                        <div class="static-parent" id="statistics-parent">
                            <button class="btn cusTheme-dark icon smallpadd mb-4 pinunpin pinned" id="pinunpin"><i class="fa-solid fa-thumbtack"></i><i class="fa-solid fa-link-slash"></i></button>
                            <!-- Total Expense -->
                            <div class="col-sm-12 col-md-12 mb-4 statcis-box px-0">
                                <i class="fa-solid fa-file-invoice back-icon"></i>
                                <div class="statistics-details px-4 py-4">
                                    <p class="static-box-title text-cusTheme">{{ __('lang_v1.expense') }}</p>
                                    <div class="d-flex">
                                        <h3 class="rate-percentage total_expense static-box-text"><i
                                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></h3>
                                        <div class="percent-tag"><i class="fa-solid fa-caret-up text-green"></i> 20%</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Purchase -->
                            <div class="col-sm-12 col-md-12 mb-4 statcis-box px-0">
                                <i class="fa-solid fa-cart-shopping back-icon"></i>
                                <div class="statistics-details px-4 py-4">
                                    <p class="static-box-title text-cusTheme">{{ __('home.total_purchase') }}</p>
                                    <div class="d-flex">
                                        <h3 class="rate-percentage total_purchase static-box-text" id="get_total_purchase">
                                            <i class="fas fa-sync fa-spin fa-fw "></i></h3>
                                        <div class="percent-tag"><i class="fa-solid fa-caret-down text-red"></i> 20%</div>
                                    </div>
                                    <div class="info-box-content" style="display: none">
                                        <span class="info-box-text">{{ __('lang_v1.total_purchase_return') }}</span>
                                        <span id="get_total_purchase_return" class="info-box-number total_purchase_return"><i class="fas fa-sync fa-spin fa-fw margin-bottom"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Purchase Due -->
                            <div class="col-sm-12 col-md-12 mb-4 statcis-box px-0">
                                <i class="fa-solid fa-cart-shopping back-icon"></i>
                                <div class="statistics-details px-4 py-4">
                                    <p class="static-box-title text-cusTheme">{{ __('home.purchase_due') }}</p>
                                    <div class="d-flex">
                                        <h3 class="rate-percentage purchase_due static-box-text"><i
                                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></h3>
                                        <div class="percent-tag"><i class="fa-solid fa-caret-down text-red"></i> 20%</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Sell -->
                            <div class="col-sm-12 col-md-12 mb-4 statcis-box px-0">
                                <i class="fa-solid fa-coins back-icon"></i>
                                <div class="statistics-details px-4 py-4">
                                    <p class="static-box-title text-cusTheme">{{ __('home.total_sell') }}</p>
                                    <div class="d-flex">
                                        <h3 class="rate-percentage total_sell static-box-text" id="get_total_sell"><i
                                                class="fas fa-sync fa-spin fa-fw margin-bottom avatar-title"></i></h3>
                                        <div class="percent-tag"><i class="fa-solid fa-caret-up text-green"></i> 20%</div>
                                    </div>
                                    <div class="info-box-content" style="display: none">
                                        <span class="info-box-text">{{ __('lang_v1.total_sell_return') }}</span>
                                        <span class="info-box-number total_sell_return" id="get_total_sell_return">
                                            <i class="fas fa-sync fa-spin fa-fw margin-bottom"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Net Revenue -->
                            <div class="col-sm-12 col-md-12 mb-4 statcis-box px-0">
                                <i class="fa-solid fa-network-wired back-icon"></i>
                                <div class="statistics-details px-4 py-4">
                                    <p class="static-box-title text-cusTheme">{{ __('lang_v1.net') }}
                                        @show_tooltip(__('lang_v1.net_home_tooltip'))</p>
                                    <div class="d-flex">
                                        <h3 class="rate-percentage net static-box-text"><i
                                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></h3>
                                        <div class="percent-tag"><i class="fa-solid fa-caret-down text-red"></i> 20%</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Invoice Due -->
                            <div class="col-sm-12 col-md-12 mb-0 statcis-box px-0">
                                <i class="fa-solid fa-file-invoice-dollar back-icon"></i>
                                <div class="statistics-details px-4 py-4">
                                    <p class="static-box-title text-cusTheme">{{ __('home.invoice_due') }}</p>
                                    <div class="d-flex">
                                        <h3 class="rate-percentage invoice_due static-box-text"><i
                                                class="fas fa-sync fa-spin fa-fw margin-bottom"></i></h3>
                                        <div class="percent-tag"><i class="fa-solid fa-caret-down text-red"></i> 20%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Product Stock Alert  --}}
                @can('stock_report.view')
                    <div class="row mt-4">

                        <div class="col-md-12 mb-6 px-0">
                            <div class="graph-details px-4 py-4">
                                <div class="px-2 py-2">
                                    <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">{{ __('home.product_stock_alert') }} @show_tooltip(__('tooltip.product_stock_alert'))</h2>
                                    <hr class="cusColor mt-3">
                                    <div class="row">
                                        @if (count($all_locations) > 1)
                                            <div class="float-right col-md-4 col-xs-12">
                                                {!! Form::select('stock_alert_location', $all_locations, null, [
                                                    'class' => 'form-control select2',
                                                    'placeholder' => __('lang_v1.select_location'),
                                                    'id' => 'stock_alert_location',
                                                ]) !!}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row px-3">
                                        <div class="card-body table-responsive">
                                            <table class="table table-bordered table-striped" id="stock_alert_table">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('sale.product')</th>
                                                        <th>@lang('business.location')</th>
                                                        <th>@lang('report.current_stock')</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- <div class="@if (session('business.enable_product_expiry') != 1 && auth()->user()->can('stock_report.view')) col-md-12 @else col-md-12 @endif">
                                        
                                    </div> --}}
                                </div>
                            </div>
                        </div>


                        @if (session('business.enable_product_expiry') == 1)
                            <div class="col-md-12 mb-4 px-0">
                                <div class="graph-details px-4 py-4">
                                    <div class="px-2 py-2">
                                        <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">{{ __('home.stock_expiry_alert') }}
                                            @show_tooltip(__('tooltip.stock_expiry_alert', ['days' =>
                                            session('business.stock_expiry_alert_days', 30)]))
                                        </h2>
                                        <hr class="cusColor mt-3">
                                        <div class="row px-4">
                                            <div class="px-2 col-md-4 col-xs-12">
                                                <input type="hidden" class="form-control" id="stock_expiry_alert_days" value="{{ \Carbon::now()->addDays(session('business.stock_expiry_alert_days', 30))->format('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="row px-3">
                                            <div class="card-body table-responsive">
                                                <table class="table table-bordered table-striped" id="stock_expiry_alert_table">
                                                    <thead>
                                                        <tr>
                                                            <th>@lang('business.product')</th>
                                                            <th>@lang('business.location')</th>
                                                            <th>@lang('report.stock_left')</th>
                                                            <th>@lang('product.expires_in')</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endcan

                @if (!empty($widgets['after_sale_purchase_totals']))
                    @foreach ($widgets['after_sale_purchase_totals'] as $widget)
                        {!! $widget !!}
                    @endforeach
                @endif
            @endif
            <!-- end is_admin check -->

            @if (!$is_admin)
                @if (auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))
                    @if (!empty($all_locations))
                        <!-- sales chart start -->
                        <div class="col-md-12 mb-6 px-0">
                            <div class="graph-details px-4 py-4">
                                <div class="px-2 py-2">
                                    <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">{{ __('home.sells_last_30_days') }}</h2>
                                    <hr class="cusColor mt-3">
                                    {!! $sells_chart_1->container() !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (!empty($widgets['after_sales_last_30_days']))
                        @foreach ($widgets['after_sales_last_30_days'] as $widget)
                            {!! $widget !!}
                        @endforeach
                    @endif

                    @if (!empty($all_locations))
                        <div class="col-md-12 px-0">
                            <div class="graph-details px-4 py-4">
                                <div class="px-2 py-2">
                                    <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">{{ __('home.sells_current_fy') }}</h2>
                                    <hr class="cusColor mt-3">
                                    {!! $sells_chart_2->container() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endif

            <!-- sales chart end -->
            @if (!empty($widgets['after_sales_current_fy']))
                @foreach ($widgets['after_sales_current_fy'] as $widget)
                    {!! $widget !!}
                @endforeach
            @endif

            <!-- products less than alert quntity -->
            <div class="row mt-4 mb-4">
                <div class="col-md-12 mb-4 px-0">
                    @if (auth()->user()->can('sell.view') || auth()->user()->can('direct_sell.view'))
                        <div class="graph-details px-4 py-4">
                            <div class="px-2 py-2">
                                <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">{{ __('lang_v1.sales_payment_dues') }} @show_tooltip(__('lang_v1.tooltip_sales_payment_dues'))</h2>
                                <hr class="cusColor mt-3">
                                <div class="row">
                                    @if (count($all_locations) > 1)
                                        <div class="float-right col-md-4 col-xs-12">
                                            {!! Form::select('sales_payment_dues_location', $all_locations, null, [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('lang_v1.select_location'),
                                                'id' => 'sales_payment_dues_location',
                                            ]) !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="row px-3">
                                    <div class="card-body table-responsive">
                                        <table class="table table-bordered table-striped" id="sales_payment_dues_table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('contact.customer')</th>
                                                    <th>@lang('sale.invoice_no')</th>
                                                    <th>@lang('home.due_amount')</th>
                                                    <th>@lang('messages.action')</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        @endif


        <div class="row mt-4 mb-4">
            <div class="col-md-12 mb-6 px-0">
                @can('purchase.view')
                    <div class="graph-details px-4 py-4">
                        <div class="px-2 py-2">
                            <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">{{ __('lang_v1.purchase_payment_dues') }} @show_tooltip(__('tooltip.payment_dues'))</h2>
                            <hr class="cusColor mt-3">
                            @if (count($all_locations) > 1)
                                <div class="row">
                                    <div class="float-right col-md-4 col-xs-12">
                                        {!! Form::select('purchase_payment_dues_location', $all_locations, null, [
                                            'class' => 'form-control select2',
                                            'placeholder' => __('lang_v1.select_location'),
                                            'id' => 'purchase_payment_dues_location',
                                        ]) !!}
                                    </div>
                                </div>
                            @endif
                            <div class="row px-3">
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered table-striped" id="purchase_payment_dues_table">
                                        <thead>
                                            <tr>
                                                <th>@lang('purchase.supplier')</th>
                                                <th>@lang('purchase.ref_no')</th>
                                                <th>@lang('home.due_amount')</th>
                                                <th>@lang('messages.action')</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>

            {{-- sales order  --}}
            @if (auth()->user()->can('so.view_all') || auth()->user()->can('so.view_own'))
                {{-- <div class="row mt-4 mb-4"> --}}
                    <div class="col-md-12 mb-6 px-0">
                        <div class="graph-details px-4 py-4">
                            <div class="px-2 py-2">
                                <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">{{ __('lang_v1.sales_order') }}</h2>
                                <hr class="cusColor mt-3">
                                @if (count($all_locations) > 1)
                                    <div class="row">
                                        <div class="float-right col-md-4 col-xs-12">
                                            {!! Form::select('so_location', $all_locations, null, [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('lang_v1.select_location'),
                                                'id' => 'so_location',
                                            ]) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row px-3">
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered table-striped ajax_view" id="sales_order_table">
                                        <thead>
                                            <tr>
                                                <th>@lang('messages.action')</th>
                                                <th>@lang('messages.date')</th>
                                                <th>@lang('restaurant.order_no')</th>
                                                <th>@lang('sale.customer_name')</th>
                                                <th>@lang('lang_v1.contact_no')</th>
                                                <th>@lang('sale.location')</th>
                                                <th>@lang('sale.status')</th>
                                                <th>@lang('lang_v1.shipping_status')</th>
                                                <th>@lang('lang_v1.quantity_remaining')</th>
                                                <th>@lang('lang_v1.added_by')</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            @endif

            @if (!empty($common_settings['enable_purchase_requisition']) && (auth()->user()->can('purchase_requisition.view_all') || auth()->user()->can('purchase_requisition.view_own')))
                {{-- <div class="row mt-4 mb-4"> --}}
                    <div class="col-md-12 mb-6 px-0">
                        <div class="graph-details px-4 py-4">
                            <div class="px-2 py-2">
                                <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">@lang('lang_v1.purchase_requisition')</h2>
                                <hr class="cusColor mt-3">

                                @if (count($all_locations) > 1)
                                    <div class="row">
                                        <div class="float-right col-md-4 col-xs-12">
                                            {!! Form::select('pr_location', $all_locations, null, [
                                                'class' => 'form-control select2',
                                                'placeholder' => __('lang_v1.select_location'),
                                                'id' => 'pr_location',
                                            ]) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row px-3">
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered table-striped ajax_view" id="purchase_requisition_table">
                                        <thead>
                                            <tr>
                                                <th>@lang('messages.action')</th>
                                                <th>@lang('messages.date')</th>
                                                <th>@lang('purchase.ref_no')</th>
                                                <th>@lang('purchase.location')</th>
                                                <th>@lang('sale.status')</th>
                                                <th>@lang('lang_v1.required_by_date')</th>
                                                <th>@lang('lang_v1.added_by')</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            @endif

            @if (!empty($common_settings['enable_purchase_order']) && (auth()->user()->can('purchase_order.view_all') || auth()->user()->can('purchase_order.view_own')))
                <div class="col-md-12 mb-6 px-0">
                    <div class="graph-details px-4 py-4">
                        <div class="px-2 py-2">
                            <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">@lang('lang_v1.purchase_order')</h2>
                            <hr class="cusColor mt-3">

                            @if (count($all_locations) > 1)
                                <div class="row">
                                    <div class="float-right col-md-4 col-xs-12">
                                        {!! Form::select('po_location', $all_locations, null, [
                                            'class' => 'form-control select2',
                                            'placeholder' => __('lang_v1.select_location'),
                                            'id' => 'po_location',
                                        ]) !!}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="row px-3">
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped ajax_view" id="purchase_order_table">
                                    <thead>
                                        <tr>
                                            <th>@lang('messages.action')</th>
                                            <th>@lang('messages.date')</th>
                                            <th>@lang('purchase.ref_no')</th>
                                            <th>@lang('purchase.location')</th>
                                            <th>@lang('purchase.supplier')</th>
                                            <th>@lang('sale.status')</th>
                                            <th>@lang('lang_v1.quantity_remaining')</th>
                                            <th>@lang('lang_v1.added_by')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- pending shipments --}}
            @if (auth()->user()->can('access_pending_shipments_only') || auth()->user()->can('access_shipping') || auth()->user()->can('access_own_shipping'))
                <div class="col-md-12 mb-6 px-0">
                    <div class="graph-details px-4 py-4">
                        <div class="px-2 py-2">
                            <h2 class="mt-0 mx-4 text-center text-cusTheme-dark fsz-25">@lang('lang_v1.pending_shipments')</h2>
                            <hr class="cusColor mt-3">
                            @if (count($all_locations) > 1)
                                <div class="row">
                                    <div class="float-right col-md-4 col-xs-12">
                                        {!! Form::select('pending_shipments_location', $all_locations, null, [
                                            'class' => 'form-control select2',
                                            'placeholder' => __('lang_v1.select_location'),
                                            'id' => 'pending_shipments_location',
                                        ]) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    
                        <div class="row px-3">
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped ajax_view" id="shipments_table">
                                    <thead>
                                        <tr>
                                            <th>@lang('messages.action')</th>
                                            <th>@lang('messages.date')</th>
                                            <th>@lang('sale.invoice_no')</th>
                                            <th>@lang('sale.customer_name')</th>
                                            <th>@lang('lang_v1.contact_no')</th>
                                            <th>@lang('sale.location')</th>
                                            <th>@lang('lang_v1.shipping_status')</th>
                                            @if (!empty($custom_labels['shipping']['custom_field_1']))
                                                <th>{{ $custom_labels['shipping']['custom_field_1'] }}</th>
                                            @endif
                                            @if (!empty($custom_labels['shipping']['custom_field_2']))
                                                <th>{{ $custom_labels['shipping']['custom_field_2'] }}</th>
                                            @endif
                                            @if (!empty($custom_labels['shipping']['custom_field_3']))
                                                <th>{{ $custom_labels['shipping']['custom_field_3'] }}</th>
                                            @endif
                                            @if (!empty($custom_labels['shipping']['custom_field_4']))
                                                <th>{{ $custom_labels['shipping']['custom_field_4'] }}</th>
                                            @endif
                                            @if (!empty($custom_labels['shipping']['custom_field_5']))
                                                <th>{{ $custom_labels['shipping']['custom_field_5'] }}</th>
                                            @endif
                                            <th>@lang('sale.payment_status')</th>
                                            <th>@lang('restaurant.service_staff')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>


        @if (auth()->user()->can('account.access') && config('constants.show_payments_recovered_today') == true)
            @component('components.widget', ['class' => 'box-warning'])
                @slot('icon')
                    <i class="fas fa-money-bill-alt text-yellow fa-lg" aria-hidden="true"></i>
                @endslot
                @slot('title')
                    @lang('lang_v1.payment_recovered_today')
                @endslot
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="cash_flow_table">
                        <thead>
                            <tr>
                                <th>@lang('messages.date')</th>
                                <th>@lang('account.account')</th>
                                <th>@lang('lang_v1.description')</th>
                                <th>@lang('lang_v1.payment_method')</th>
                                <th>@lang('lang_v1.payment_details')</th>
                                <th>@lang('account.credit')</th>
                                <th>@lang('lang_v1.account_balance') @show_tooltip(__('lang_v1.account_balance_tooltip'))</th>
                                <th>@lang('lang_v1.total_balance') @show_tooltip(__('lang_v1.total_balance_tooltip'))</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total text-center">
                                <td colspan="5"><strong>@lang('sale.total'):</strong></td>
                                <td class="footer_total_credit"></td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @endcomponent
        @endif

        @if (!empty($widgets['after_dashboard_reports']))
            @foreach ($widgets['after_dashboard_reports'] as $widget)
                {!! $widget !!}
            @endforeach
        @endif

        @endif


    </section>
    <!-- /.content -->
    <div class="modal fade payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade edit_pso_status_modal" tabindex="-1" role="dialog"></div>
    <div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>
@stop
@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script src="{{ asset('js/home.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
    @includeIf('sales_order.common_js')
    @includeIf('purchase_order.common_js')
    @if (!empty($all_locations))
        {!! $sells_chart_1->script() !!}
        {!! $sells_chart_2->script() !!}
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            sales_order_table = $('#sales_order_table').DataTable({
                processing: true,
                serverSide: true,
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                aaSorting: [
                    [1, 'desc']
                ],
                "ajax": {
                    "url": '{{ action([\App\Http\Controllers\SellController::class, 'index']) }}?sale_type=sales_order',
                    "data": function(d) {
                        d.for_dashboard_sales_order = true;

                        if ($('#so_location').length > 0) {
                            d.location_id = $('#so_location').val();
                        }
                    }
                },
                columnDefs: [{
                    "targets": 7,
                    "orderable": false,
                    "searchable": false
                }],
                columns: [{
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'invoice_no',
                        name: 'invoice_no'
                    },
                    {
                        data: 'conatct_name',
                        name: 'conatct_name'
                    },
                    {
                        data: 'mobile',
                        name: 'contacts.mobile'
                    },
                    {
                        data: 'business_location',
                        name: 'bl.name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'shipping_status',
                        name: 'shipping_status'
                    },
                    {
                        data: 'so_qty_remaining',
                        name: 'so_qty_remaining',
                        "searchable": false
                    },
                    {
                        data: 'added_by',
                        name: 'u.first_name'
                    },
                ]
            });

            @if (auth()->user()->can('account.access') && config('constants.show_payments_recovered_today') == true)

                // Cash Flow Table
                cash_flow_table = $('#cash_flow_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "{{ action([\App\Http\Controllers\AccountController::class, 'cashFlow']) }}",
                        "data": function(d) {
                            d.type = 'credit';
                            d.only_payment_recovered = true;
                        }
                    },
                    "ordering": false,
                    "searching": false,
                    columns: [{
                            data: 'operation_date',
                            name: 'operation_date'
                        },
                        {
                            data: 'account_name',
                            name: 'account_name'
                        },
                        {
                            data: 'sub_type',
                            name: 'sub_type'
                        },
                        {
                            data: 'method',
                            name: 'TP.method'
                        },
                        {
                            data: 'payment_details',
                            name: 'payment_details',
                            searchable: false
                        },
                        {
                            data: 'credit',
                            name: 'amount'
                        },
                        {
                            data: 'balance',
                            name: 'balance'
                        },
                        {
                            data: 'total_balance',
                            name: 'total_balance'
                        },
                    ],
                    "fnDrawCallback": function(oSettings) {
                        __currency_convert_recursively($('#cash_flow_table'));
                    },
                    "footerCallback": function(row, data, start, end, display) {
                        var footer_total_credit = 0;

                        for (var r in data) {
                            footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(
                                data[r].credit).data('orig-value')) : 0;
                        }
                        $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit));
                    }
                });
            @endif

            $('#so_location').change(function() {
                sales_order_table.ajax.reload();
            });
            @if (!empty($common_settings['enable_purchase_order']))
                //Purchase table
                purchase_order_table = $('#purchase_order_table').DataTable({
                    processing: true,
                    serverSide: true,
                    aaSorting: [
                        [1, 'desc']
                    ],
                    scrollY: "75vh",
                    scrollX: true,
                    scrollCollapse: true,
                    ajax: {
                        url: '{{ action([\App\Http\Controllers\PurchaseOrderController::class, 'index']) }}',
                        data: function(d) {
                            d.from_dashboard = true;

                            if ($('#po_location').length > 0) {
                                d.location_id = $('#po_location').val();
                            }
                        },
                    },
                    columns: [{
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'transaction_date',
                            name: 'transaction_date'
                        },
                        {
                            data: 'ref_no',
                            name: 'ref_no'
                        },
                        {
                            data: 'location_name',
                            name: 'BS.name'
                        },
                        {
                            data: 'name',
                            name: 'contacts.name'
                        },
                        {
                            data: 'status',
                            name: 'transactions.status'
                        },
                        {
                            data: 'po_qty_remaining',
                            name: 'po_qty_remaining',
                            "searchable": false
                        },
                        {
                            data: 'added_by',
                            name: 'u.first_name'
                        }
                    ]
                })

                $('#po_location').change(function() {
                    purchase_order_table.ajax.reload();
                });
            @endif

            @if (!empty($common_settings['enable_purchase_requisition']))
                //Purchase table
                purchase_requisition_table = $('#purchase_requisition_table').DataTable({
                    processing: true,
                    serverSide: true,
                    aaSorting: [
                        [1, 'desc']
                    ],
                    scrollY: "75vh",
                    scrollX: true,
                    scrollCollapse: true,
                    ajax: {
                        url: '{{ action([\App\Http\Controllers\PurchaseRequisitionController::class, 'index']) }}',
                        data: function(d) {
                            d.from_dashboard = true;

                            if ($('#pr_location').length > 0) {
                                d.location_id = $('#pr_location').val();
                            }
                        },
                    },
                    columns: [{
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'transaction_date',
                            name: 'transaction_date'
                        },
                        {
                            data: 'ref_no',
                            name: 'ref_no'
                        },
                        {
                            data: 'location_name',
                            name: 'BS.name'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'delivery_date',
                            name: 'delivery_date'
                        },
                        {
                            data: 'added_by',
                            name: 'u.first_name'
                        },
                    ]
                })

                $('#pr_location').change(function() {
                    purchase_requisition_table.ajax.reload();
                });

                $(document).on('click', 'a.delete-purchase-requisition', function(e) {
                    e.preventDefault();
                    swal({
                        title: LANG.sure,
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    }).then(willDelete => {
                        if (willDelete) {
                            var href = $(this).attr('href');
                            $.ajax({
                                method: 'DELETE',
                                url: href,
                                dataType: 'json',
                                success: function(result) {
                                    if (result.success == true) {
                                        toastr.success(result.msg);
                                        purchase_requisition_table.ajax.reload();
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    });
                });
            @endif

            sell_table = $('#shipments_table').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [
                    [1, 'desc']
                ],
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                "ajax": {
                    "url": '{{ action([\App\Http\Controllers\SellController::class, 'index']) }}',
                    "data": function(d) {
                        d.only_pending_shipments = true;
                        if ($('#pending_shipments_location').length > 0) {
                            d.location_id = $('#pending_shipments_location').val();
                        }
                    }
                },
                columns: [{
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'transaction_date',
                        name: 'transaction_date'
                    },
                    {
                        data: 'invoice_no',
                        name: 'invoice_no'
                    },
                    {
                        data: 'conatct_name',
                        name: 'conatct_name'
                    },
                    {
                        data: 'mobile',
                        name: 'contacts.mobile'
                    },
                    {
                        data: 'business_location',
                        name: 'bl.name'
                    },
                    {
                        data: 'shipping_status',
                        name: 'shipping_status'
                    },
                    @if (!empty($custom_labels['shipping']['custom_field_1']))
                        {
                            data: 'shipping_custom_field_1',
                            name: 'shipping_custom_field_1'
                        },
                    @endif
                    @if (!empty($custom_labels['shipping']['custom_field_2']))
                        {
                            data: 'shipping_custom_field_2',
                            name: 'shipping_custom_field_2'
                        },
                    @endif
                    @if (!empty($custom_labels['shipping']['custom_field_3']))
                        {
                            data: 'shipping_custom_field_3',
                            name: 'shipping_custom_field_3'
                        },
                    @endif
                    @if (!empty($custom_labels['shipping']['custom_field_4']))
                        {
                            data: 'shipping_custom_field_4',
                            name: 'shipping_custom_field_4'
                        },
                    @endif
                    @if (!empty($custom_labels['shipping']['custom_field_5']))
                        {
                            data: 'shipping_custom_field_5',
                            name: 'shipping_custom_field_5'
                        },
                    @endif {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'waiter',
                        name: 'ss.first_name',
                        @if (empty($is_service_staff_enabled))
                            visible: false
                        @endif
                    }
                ],
                "fnDrawCallback": function(oSettings) {
                    __currency_convert_recursively($('#sell_table'));
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:eq(4)').attr('class', 'clickable_td');
                }
            });

            $('#pending_shipments_location').change(function() {
                sell_table.ajax.reload();
            });
        });
    </script>
    <script>
        function onDocumentReady() {
            // Function to extract numeric value from a string like "£ 540.00"
            function extractNumericValue(str) {
                return parseFloat(str.replace(/[^0-9.-]+/g, ""));
            }

            // Get data from elements


            var totalSellValue = extractNumericValue(document.getElementById("get_total_sell").textContent);
            var totalSellReturnValue = extractNumericValue(document.getElementById("get_total_sell_return").textContent);
            var totalPurchaseValue = extractNumericValue(document.getElementById("get_total_purchase").textContent);
            var totalPurchaseReturnValue = extractNumericValue(document.getElementById("get_total_purchase_return")
                .textContent);

            // Create a doughnut chart for the Sell Chart
            var ctxSell = document.getElementById('sellChart').getContext('2d');
            var sellChart = new Chart(ctxSell, {
                type: 'doughnut',
                data: {
                    labels: ['Total Sell', 'Total Sell Return'],
                    datasets: [{
                        data: [totalSellValue, totalSellReturnValue],
                        backgroundColor: [
                            'rgba(15,109,248,0.6)',
                            'rgba(241,16,64,.6)',
                        ],
                        borderColor: [
                            'rgba(15, 109, 248, 1)',
                            'rgba(241, 16, 64, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    cutout: '70%', // Create a doughnut hole in the center
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        datalabels: {
                            color: '#333',
                            formatter: (value, ctx) => {
                                return value + ' £';
                            }
                        }
                    }
                }
            });

            // Test 
            const xValues = ["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيه", "يوليو", "اغسطس", "سبتمبر", "اكتوبر",
                "نوفمبر", "ديسمبر"
            ];
            const yValues = [3, 7, 8, 7, 9, 7, 8, 10, 9, 11, 11, 12];

            new Chart("myChart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: "#0249AC",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yValues
                    }]
                },
                // options:{...}
            });

            // Create a doughnut chart for the Purchase Chart
            var ctxPurchase = document.getElementById('purchaseChart').getContext('2d');
            var purchaseChart = new Chart(ctxPurchase, {
                type: 'doughnut',
                data: {
                    labels: ['Total Purchase', 'Total Purchase Return'],
                    datasets: [{
                        data: [totalPurchaseValue, totalPurchaseReturnValue],
                        backgroundColor: [
                            'rgba(15,109,248,0.6)',
                            'rgba(241,16,64,.6)',
                        ],
                        borderColor: [
                            'rgba(15,109,248,1)',
                            'rgba(241,16,64,1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    cutout: '70%', // Create a doughnut hole in the center
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        datalabels: {
                            color: '#333',
                            formatter: (value, ctx) => {
                                return value + ' £';
                            }
                        }
                    }
                }
            });

        }

        //ovserver
        // Function to change the content of the element
        function changeContent() {

            // Get a reference to the target element
            const targetElement = document.getElementById('get_total_sell');

            // Create a new MutationObserver instance
            const observer = new MutationObserver((mutationsList, observer) => {
                // Callback function to be executed when changes are observed

                // Loop through each mutation
                for (const mutation of mutationsList) {
                    if (mutation.type === 'childList' && mutation.target === targetElement) {
                        // Content of the target element has changed
                        // document.getElementById('sellChart').destroy();
                        // var grapharea = document.getElementById("sellChart").getContext("2d");

                        // grapharea.destroy();
                        let chartStatus = Chart.getChart("sellChart"); // <canvas> id
                        if (chartStatus != undefined) {
                            chartStatus.destroy();
                        }
                        let purchaseChart = Chart.getChart("purchaseChart"); // <canvas> id
                        if (purchaseChart != undefined) {
                            purchaseChart.destroy();
                        }
                        onDocumentReady();
                    }
                }
            });

            // Configure and start observing the target element
            const config = {
                childList: true,
                subtree: true
            };
            observer.observe(targetElement, config);

            // You can later disconnect the observer if needed
            // observer.disconnect();
        }

        // Attach the function to the DOMContentLoaded event
        document.addEventListener("DOMContentLoaded", function() {
            // Use setTimeout to delay the execution by 5000 milliseconds (5 seconds)
            setTimeout(onDocumentReady, 2000);
            setTimeout(changeContent, 3000);
        });
    </script>
@endsection

<script src="{{ asset('assets/backend/js/custom.js?v=' . $asset_v) }}" defer></script>


{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css@1.1.0/dist/charts.min.css" />
<style>
    #orientation-example-15 {
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }

    #orientation-example-15 .area {
        --aspect-ratio: 16 / 9;
    }
</style> --}}
