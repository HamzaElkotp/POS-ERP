<div class="row" id="featured_products_box" style="display: none;">
    @if (!empty($featured_products))
        @include('sale_pos.partials.featured_products')
    @endif
</div>
<div class="row">
    @if (!empty($brands))
        <div class="col-md-12 mb-10" id="product_brand_div" style="display: none">
            {!! Form::select('size', $brands, null, [
                'id' => 'product_brand',
                'class' => 'select2',
                'name' => null,
                'style' => 'width:100% !important; display: none;',
                'optionsToBoxes' => 'brand-carsole'
            ]) !!}
        </div>

        <div class="carsole-container" carsole="brand-carsole" opt2box-carsole="brand-carsole" linkedto="product_brand">
			<div class="d-flex ltr-flexreverse-row">
                <div rightbtn="brand-carsole" class="btn cusTheme-dark btn-sm outline sm mx-1"><i class="fa-solid fa-caret-right"></i></div>
			    <div leftbtn="brand-carsole" class="btn cusTheme-dark btn-sm outline sm"><i class="fa-solid fa-caret-left"></i></div>
            </div>
			<div class="longcarsole">
				<div class="carsole-box" opt2box-option="product_brand" carsol-parent="brand-carsole" optionid="all">
					<img src="https://cdn-icons-png.flaticon.com/512/5277/5277703.png">
					<p>@lang('lang_v1.all_brands')</p>
				</div>
                @php
                    $i = 0;
                @endphp
				@foreach ($brands as $brand)
                    @if($i!=0)
                        <div class="carsole-box" opt2box-option="product_brand" carsol-parent="brand-carsole" optionid="{{ $i }}">
                            <img src="https://via.placeholder.com/50">
                            <p>{{ $brand }}</p>
                        </div>
                    @endif
                    @php
                        $i++;
                    @endphp
				@endforeach			
			</div>
		</div>
    @endif

    <!-- used in repair : filter for service/product -->
    <div class="col-md-12 hide" id="product_service_div">
        {!! Form::select(
            'is_enabled_stock',
            ['' => __('messages.all'), 'product' => __('sale.product'), 'service' => __('lang_v1.service')],
            null,
            ['id' => 'is_enabled_stock', 'class' => 'select2', 'name' => null, 'style' => 'width:100% !important'],
        ) !!}
    </div>

    <div class="col-sm-12 @if (empty($featured_products)) hide @endif" id="feature_product_div">
        <button type="button" class="btn btn-primary btn-flat"
            id="show_featured_products">@lang('lang_v1.featured_products')</button>
    </div>
</div>
<br>
<div class="row">
    <input type="hidden" id="suggestion_page" value="1">
    <div class="col-md-12 px-0">
        <div class="eq-height-row" id="product_list_body"></div>
    </div>
    <div class="col-md-12 text-center" id="suggestion_page_loader" style="display: none;">
        <i class="fa fa-spinner fa-spin fa-2x"></i>
    </div>
</div>





<script src="{{ asset('assets/backend/js/models/carsol.js?v='.$asset_v) }}"></script>

