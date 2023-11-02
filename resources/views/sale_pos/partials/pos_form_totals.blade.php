<div class="row pos_form_totals">

	<div class="col-md-12 mb-4 px-0">
		<div class="col-md-6 px-3">
			<div class="py-4 px-4 cusBoxAnlys">
				<div class="boxTitle d-flex">
					<div class="icon_Boxer">
						<i class="fa-solid fa-boxes-stacked fsz-35 text-white"></i>
					</div>
					<div class="text-center textContenter">
						<p class="fw-500 fs-2 mb-1 text-black">@lang('sale.item')</p>
						<span class="total_quantity fs-1 fw-400 d-block text-cusTheme">0</span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 px-3">
			<div class="py-4 px-4 cusBoxAnlys">
				<div class="boxTitle d-flex">
					<div class="icon_Boxer">
						<i class="fa-solid fa-dollar-sign fsz-35 text-white"></i>
					</div>
					<div class="text-center textContenter">
						<p class="fw-500 fs-2 mb-1 text-black">@lang('sale.total')</p>
						<span class="price_total fs-1 fw-400 d-block text-cusTheme">0</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr class="cusTheme">

	<div class="col-md-12 px-0">
		<div class="col-md-3 px-3">
			<div class="py-4 px-4 cusBoxAnlys text-center ">
				@if($is_discount_enabled)
					<div class="d-flex boxTitle align-items-center">
						@if($edit_discount)
							<i class="fas fa-edit cursor-pointer text-cusTheme" id="pos-edit-discount" title="@lang('sale.edit_discount')" aria-hidden="true" data-toggle="modal" data-target="#posEditDiscountModal"></i>
						@endif
						<p class="fw-500 fs-2 mb-1 text-black">
							@lang('sale.discount')
							@show_tooltip(__('tooltip.sale_discount'))
							@if($is_discount_enabled)
								(-)
							@endif
						</p>
					</div>
				@endif
				@if($is_rp_enabled)
					{{session('business.rp_name')}}
				@endif
				@if($is_discount_enabled)
					<span id="total_discount" class="fw-400 fs-1 fw-400 d-block text-cusTheme text-center">0</span>
				@endif
					<input type="hidden" name="discount_type" id="discount_type" value="@if(empty($edit)){{'percentage'}}@else{{$transaction->discount_type}}@endif" data-default="percentage">
					<input type="hidden" name="discount_amount" id="discount_amount" value="@if(empty($edit)) {{@num_format($business_details->default_sales_discount)}} @else {{@num_format($transaction->discount_amount)}} @endif" data-default="{{$business_details->default_sales_discount}}">
					<input type="hidden" name="rp_redeemed" id="rp_redeemed" value="@if(empty($edit)){{'0'}}@else{{$transaction->rp_redeemed}}@endif">
					<input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="@if(empty($edit)){{'0'}}@else {{$transaction->rp_redeemed_amount}} @endif">
			</div>
		</div>

		<div class="col-md-3 px-3 @if($pos_settings['disable_order_tax'] != 0) hide @endif">
			<div class="py-4 px-4 cusBoxAnlys text-center">
				<div class="d-flex boxTitle align-items-center">
					<i class="fas fa-edit cursor-pointer text-cusTheme" title="@lang('sale.edit_order_tax')" aria-hidden="true" data-toggle="modal" data-target="#posEditOrderTaxModal" id="pos-edit-tax" ></i> 
					<p class="fw-500 fs-3 mb-1 text-black">@lang('sale.order_tax') @show_tooltip(__('tooltip.sale_tax')) (+)</p>
				</div>
				<span id="order_tax" class="fw-400 fs-1 fw-400 d-block text-cusTheme text-center">
					@if(empty($edit))
						0
					@else
						{{$transaction->tax_amount}}
					@endif
				</span>

				<input type="hidden" name="tax_rate_id" 
					id="tax_rate_id" 
					value="@if(empty($edit)) {{$business_details->default_sales_tax}} @else {{$transaction->tax_id}} @endif" 
					data-default="{{$business_details->default_sales_tax}}">
				<input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" value="@if(empty($edit)) {{@num_format($business_details->tax_calculation_amount)}} @else {{@num_format($transaction->tax?->amount)}} @endif" data-default="{{$business_details->tax_calculation_amount}}">
			</div>
		</div>

		<div class="col-md-3 px-3">
			<div class="py-4 px-4 cusBoxAnlys text-center ">
				<div class="d-flex boxTitle align-items-center">
					<i class="fas fa-edit cursor-pointer text-cusTheme"  title="@lang('sale.shipping')" aria-hidden="true" data-toggle="modal" data-target="#posShippingModal"></i>
					<p class="fw-500 fs-2 mb-1 text-black">@lang('sale.shipping') @show_tooltip(__('tooltip.shipping')) (+)</p> 
				</div>
				<span id="shipping_charges_amount" class="fw-400 fs-1 fw-400 d-block text-cusTheme text-center">0</span>
				<input type="hidden" name="shipping_details" id="shipping_details" value="@if(empty($edit)){{''}}@else{{$transaction->shipping_details}}@endif" data-default="">
				<input type="hidden" name="shipping_address" id="shipping_address" value="@if(empty($edit)){{''}}@else{{$transaction->shipping_address}}@endif">
				<input type="hidden" name="shipping_status" id="shipping_status" value="@if(empty($edit)){{''}}@else{{$transaction->shipping_status}}@endif">
				<input type="hidden" name="delivered_to" id="delivered_to" value="@if(empty($edit)){{''}}@else{{$transaction->delivered_to}}@endif">
				<input type="hidden" name="shipping_charges" id="shipping_charges" value="@if(empty($edit)){{@num_format(0.00)}} @else{{@num_format($transaction->shipping_charges)}} @endif" data-default="0.00">
			</div>
		</div>

		@if(in_array('types_of_service', $enabled_modules))
			<div class="col-md-3 px-3">
				<div class="py-4 px-4 cusBoxAnlys text-center ">
					<div class="d-flex boxTitle align-items-center">
						<i class="fas fa-edit cursor-pointer service_modal_btn text-cusTheme"></i> 
						<p class="fw-500 fs-2 mb-1 text-black">@lang('lang_v1.packing_charge') (+)</p>
					</div>
					<span id="packing_charge_text" class="fw-400 fs-1 fw-400 d-block text-cusTheme text-center">
						0
					</span>
				</div>
			</div>
		@endif

		@if(!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0)
			<div class="col-md-3 px-3">
				<div class="py-4 px-4 cusBoxAnlys text-center ">
					<div class="d-flex boxTitle align-items-center">
						<p class="fw-500 fs-2 mb-1 text-black" id="round_off">@lang('lang_v1.round_off')</span></p>	
					</div>
					<span id="round_off_text" class="fw-400 fs-1 fw-400 d-block text-cusTheme text-center">
						0
					</span>
				</div>
			</div>
		@endif
	</div>
</div>