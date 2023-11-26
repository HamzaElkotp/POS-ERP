{{-- Start Adding Custom Theme File --}}
<link rel="stylesheet" href="{{ asset('assets/backend/css/customTheme.css?v='.$asset_v) }}">
<link rel="stylesheet" href="{{ asset('assets/backend/css/customComponents.css?v='.$asset_v) }}">
<link href="{{ asset('assets/backend/css/bootstrap.min.css?v='.$asset_v) }}" rel="stylesheet">
{{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
{{-- End Adding Custom Theme File --}}

@section('content')
@section('title', __('sale.pos_sale'))
@extends('layouts.app')

<section class="content no-print">
	<div class="row">
		<div class="col-md-12">
			<div class="card mb-30 pb-1">
				@include('sale_pos.partials.pos_top_sidebar')
			</div>
		<div>
	</div>

	<input type="hidden" id="amount_rounding_method" value="{{$pos_settings['amount_rounding_method'] ?? ''}}">
	@if(!empty($pos_settings['allow_overselling']))
		<input type="hidden" id="is_overselling_allowed">
	@endif
	@if(session('business.enable_rp') == 1)
		<input type="hidden" id="reward_point_enabled">
	@endif
	@php
		$is_discount_enabled = $pos_settings['disable_discount'] != 1 ? true : false;
		$is_rp_enabled = session('business.enable_rp') == 1 ? true : false;
	@endphp
	{!! Form::open(['url' => action([\App\Http\Controllers\SellPos1Controller::class, 'store']), 'method' => 'post', 'id' => 'add_pos_sell_form' ]) !!}



	<div class="row mobile-reverse">
		<div class="@if(empty($pos_settings['hide_product_suggestion'])) col-md-8 @else col-md-10 offset-md-1 @endif">
			<div class="card mb-12 @if(!isMobile()) mb-100 @endif">
				<div class="card-body pb-0 d-block">
					{!! Form::hidden('location_id', $default_location->id ?? null, ['id' => 'location_id', 'data-receipt_printer_type' => !empty($default_location->receipt_printer_type) ? $default_location->receipt_printer_type : 'browser', 'data-default_payment_accounts' => $default_location->default_payment_accounts ?? '']) !!}
					<!-- sub_type -->
					{!! Form::hidden('sub_type', isset($sub_type) ? $sub_type : null) !!}
					<input type="hidden" class="form-control" id="item_addition_method" value="{{$business_details->item_addition_method}}">

					<div class="form-group">
						@include('sale_pos.partials.pos_form')
					</div>
					
					<div class="form-group">
						@include('sale_pos.partials.pos_form_totals')
					</div>
					
					<div class="form-group">
						@include('sale_pos.partials.payment_modal')
					</div>
					
					@if(empty($pos_settings['disable_suspend']))
					<div class="form-group">
						@include('sale_pos.partials.suspend_note_modal')
					</div>
					@endif
					
					@if(empty($pos_settings['disable_recurring_invoice']))
					<div class="form-group">
						@include('sale_pos.partials.recurring_invoice_modal')
					</div>
					@endif
				</div>
			</div>
		</div>
		
		@if(empty($pos_settings['hide_product_suggestion']) && !isMobile())
		<div class="col-md-4 mb-30 pb-1">
			<div class="card">
				<div class="card-body py-0">
					@include('sale_pos.partials.pos_sidebar')
				</div>
			</div>
		</div>
		@endif
	</div>
	
	@include('sale_pos.partials.pos_form_actions')
	{!! Form::close() !!}
</section>

<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	@include('contact.create', ['quick_add' => true])
</div>
@if(empty($pos_settings['hide_product_suggestion']) && isMobile())
	@include('sale_pos.partials.mobile_product_suggestions')
@endif
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->
<div class="modal fade quick_add_product_modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle"></div>

<div class="modal fade" id="expense_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

@include('sale_pos.partials.configure_search_modal')
@include('layouts.partials.calculator')

@include('sale_pos.partials.recent_transactions_modal')

@include('sale_pos.partials.weighing_scale_modal')

@stop
@section('css')
	<!-- include module css -->
	@if(!empty($pos_module_data))
		@foreach($pos_module_data as $key => $value)
			@if(!empty($value['module_css_path']))
				@includeIf($value['module_css_path'])
			@endif
		@endforeach
	@endif
@stop
@section('javascript')
	<script src="{{ asset('js/pos.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/printer.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/product.js?v=' . $asset_v) }}"></script>
	<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
	@include('sale_pos.partials.keyboard_shortcuts')

	<!-- Call restaurant module if defined -->
	@if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
		<script src="{{ asset('js/restaurant.js?v=' . $asset_v) }}"></script>
	@endif
	<!-- include module js -->
	@if(!empty($pos_module_data))
		@foreach($pos_module_data as $key => $value)
			@if(!empty($value['module_js_path']))
				@includeIf($value['module_js_path'], ['view_data' => $value['view_data']])
			@endif
		@endforeach
	@endif
@endsection

