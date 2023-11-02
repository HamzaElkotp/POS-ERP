<div class="row px-3">
    @if (!empty($categories))
        <div class="col-md-12 mb-10" id="product_category_div" style="display: none">
            <select class="select2" id="product_category" style="width:100% !important" optionsToBoxes="category-carsole" style="display: none">

                <option value="all">@lang('lang_v1.all_category')</option>

                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach

                @foreach ($categories as $category)
                    @if (!empty($category['sub_categories']))
                        <optgroup label="{{ $category['name'] }}">
                            @foreach ($category['sub_categories'] as $sc)
                                <i class="fa fa-minus"></i>
                                <option value="{{ $sc['id'] }}">{{ $sc['name'] }}</option>
                            @endforeach
                        </optgroup>
                    @endif
                @endforeach
            </select>
        </div>

		<div class="carsole-container" carsole="category-carsole" opt2box-carsole="category-carsole" linkedto="product_category">
			<div rightbtn="category-carsole" class="btn cusTheme-dark btn-sm outline sm"><i class="fa-solid fa-caret-right"></i></div>
			<div leftbtn="category-carsole" class="btn cusTheme-dark btn-sm outline sm"><i class="fa-solid fa-caret-left"></i></div>

			<div class="longcarsole">
				<div class="carsole-box" opt2box-option="product_category" carsol-parent="category-carsole" optionid="all">
					<img src="https://cdn-icons-png.flaticon.com/512/5277/5277703.png">
					<p>@lang('lang_v1.all_category')</p>
				</div>
				@foreach ($categories as $category)
					<div class="carsole-box" opt2box-option="product_category" carsol-parent="category-carsole" optionid="{{ $category['id'] }}">
						<img src="https://via.placeholder.com/50">
						<p>{{ $category['name'] }}</p>
					</div>
				@endforeach			
			</div>
		</div>

    @endif
</div>

{{-- <script src="{{ asset('assets/backend/js/models/carsol.js?v='.$asset_v) }}"></script> --}}