

<div class="row">
    <div class="col-12">
        <table style="width: 100%">
            <tr>
                <td class="td2">
                    <table>
                        <tr>
                            <h3 class="td1">@lang('cruds.salesInvoice.fields.left')</h3>
                        </tr>
                        <tr>

                            <td class="td3">
                                <div class="form-group" dir="ltr">
                                    <label for="add">{{ trans('cruds.salesInvoice.fields.add') }}</label>
                                    <input
                                        class="form-control inpp2 {{ $errors->has('add') ? 'is-invalid' : '' }}"
                                        type="text" name="add1" id="add"
                                        value="{{ $salesInvoice->add1 }}">
                                    @if ($errors->has('add'))
                                        <span class="text-danger">{{ $errors->first('add') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.salesInvoice.fields.add_helper') }}</span>
                                </div>
                            </td>
                            <td class="td3">
                                <div class="form-group" dir="ltr">
                                    <label
                                        for="axis">{{ trans('cruds.salesInvoice.fields.axis') }}</label>
                                    <input
                                        class="form-control axis1 inpp2 {{ $errors->has('axis') ? 'is-invalid' : '' }}"
                                        type="text" name="axis1" id="axis"
                                        value="{{ $salesInvoice->axis1 }}">
                                    @if ($errors->has('axis'))
                                        <span class="text-danger">{{ $errors->first('axis') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.salesInvoice.fields.axis_helper') }}</span>
                                </div>
                            </td>
                            <td class="td3">
                                <div class="form-group" dir="ltr">
                                    <label for="cyl">{{ trans('cruds.salesInvoice.fields.cyl') }}</label>
                                    <input
                                        class="form-control cyl1 inpp2 {{ $errors->has('cyl') ? 'is-invalid' : '' }}"
                                        type="text" name="cyl1" id="cyl1"
                                        value="{{ $salesInvoice->cyl1 }}">
                                    @if ($errors->has('notes'))
                                        <span class="text-danger">{{ $errors->first('cyl') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.salesInvoice.fields.cyl_helper') }}</span>
                                </div>
                            </td>
                            <td class="td3">
                                <div class="form-group" dir="ltr">
                                    <label for="sph">{{ trans('cruds.salesInvoice.fields.sph') }}</label>
                                    <input
                                        class="form-control sph1 inpp2 {{ $errors->has('notes') ? 'is-invalid' : '' }}"
                                        type="text" name="sph1" id="sph1"
                                        value="{{ $salesInvoice->sph1 }}">
                                    @if ($errors->has('sph'))
                                        <span class="text-danger">{{ $errors->first('sph') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.salesInvoice.fields.sph_helper') }}</span>
                                </div>
                            </td>

                        </tr>

                    </table>

                </td>
                <td class="">
                    <table>

                        <tr>

                            <td class="td3">
                                <div class="form-group" dir="ltr">
                                    <label
                                        for="pid_d">{{ trans('cruds.salesInvoice.fields.pid/d') }}</label>
                                    <input
                                        class="form-control pid_d {{ $errors->has('add') ? 'is-invalid' : '' }}"
                                        type="text" name="pid_d" id="pid_d"
                                        value="{{ $salesInvoice->pid_d }}">
                                    @if ($errors->has('add'))
                                        <span class="text-danger">{{ $errors->first('pid_d') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.salesInvoice.fields.pid/d_helper') }}</span>
                                </div>
                            </td>
                        </tr>

                    </table>

                </td>
                <td class="td2">
                    <table>
                        <tr>
                            <h3 class="td1">@lang('cruds.salesInvoice.fields.right')</h3>
                        </tr>
                        <tr>

                            <td class="td3">
                                <div class="form-group" dir="ltr">
                                    <label for="add">{{ trans('cruds.salesInvoice.fields.add') }}</label>
                                    <input
                                        class="form-control add {{ $errors->has('add') ? 'is-invalid' : '' }}"
                                        type="text" name="add" id="add" value="{{ $salesInvoice->add }}">
                                    @if ($errors->has('add'))
                                        <span class="text-danger">{{ $errors->first('add') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.salesInvoice.fields.add_helper') }}</span>
                                </div>
                            </td>
                            <td class="td3">
                                <div class="form-group" dir="ltr">
                                    <label
                                        for="axis">{{ trans('cruds.salesInvoice.fields.axis') }}</label>
                                    <input
                                        class="form-control axis{{ $errors->has('axis') ? 'is-invalid' : '' }}"
                                        type="text" name="axis" id="axis"
                                        value="{{ $salesInvoice->axis }}">
                                    @if ($errors->has('axis'))
                                        <span class="text-danger">{{ $errors->first('axis') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.salesInvoice.fields.axis_helper') }}</span>
                                </div>
                            </td>
                            <td class="td3">
                                <div class="form-group" dir="ltr">
                                    <label for="cyl">{{ trans('cruds.salesInvoice.fields.cyl') }}</label>
                                    <input
                                        class="form-control cyl {{ $errors->has('cyl') ? 'is-invalid' : '' }}"
                                        type="text" name="cyl" id="cyl" value="{{ $salesInvoice->cyl }}">
                                    @if ($errors->has('notes'))
                                        <span class="text-danger">{{ $errors->first('cyl') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.salesInvoice.fields.cyl_helper') }}</span>
                                </div>
                            </td>
                            <td class="td3">
                                <div class="form-group" dir="ltr">
                                    <label for="sph">{{ trans('cruds.salesInvoice.fields.sph') }}</label>
                                    <input
                                        class="form-control sph {{ $errors->has('notes') ? 'is-invalid' : '' }}"
                                        type="text" name="sph" id="sph" value="{{ $salesInvoice->sph }}">
                                    @if ($errors->has('sph'))
                                        <span class="text-danger">{{ $errors->first('sph') }}</span>
                                    @endif
                                    <span
                                        class="help-block">{{ trans('cruds.salesInvoice.fields.sph_helper') }}</span>
                                </div>
                            </td>
                            <td style="">
                                <h3 class="td1">Dist</h3>
                            </td>
                        </tr>

                    </table>

                </td>

            </tr>
        </table>
    </div>
</div>
@if ($salesInvoice->lens1)

<div class="row">
    <div class="col-md-6">
        <table>
            <tr class="">
                <td>
                    <div class="form-group">

                        {{-- <a href="{{ route('get_lens',[5,1.00,'s100']) }}">Add</a> --}}
                        <button class="btn btn-primary btn-sm order-prods" id="get_len_l"
                            data-url="{{ route('get_lens', [$id ?? '', $sph ?? '', $cyl ?? '']) }}"
                            data-url-price="{{ route('get_lens_price', [$id ?? '', $sph ?? '', $cyl ?? '']) }}"
                            data-method="get">
                            {{-- data-url="{{ route('admin.sales-invoices.get_lens', [$name ?? '']) }}" data-method="get"> --}}

                            <i class="fa fa-search"></i> بحث

                        </button>
                    </div>
                </td>

                <td>
                    <div class="form-group">
                        <label for="">كود</label>
                        <input readonly class="inpp" type="text" id="lens_diam_id_l"
                            value="{{ $lens1[0]->lens_diam_id }}" name="lens_diam_id_l[]">

                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="">Sph</label>
                        <input readonly class="inpp" type="text" id="sph_1_l"
                            value="{{ $lens1[0]->sph }}" name="sph_1_l[]">

                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="">Cyl</label>
                        <input readonly class="inpp" type="text" id="cyl_1_l"
                            value="{{ $lens1[0]->cyl }}" name="cyl_1_l[]">

                    </div>
                </td>

                <td>
                    <div class="form-group">
                        <label for="">السعر</label>
                        <input readonly class="inpp" type="text" id="price_l"
                            value="{{ $lens1[0]->price }}" name="price_l[]">

                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="">خصم</label>
                        <input readonly class="inpp" type="text" id="disc_l"
                            value="{{ $lens1[0]->disc }}" name="disc_l[]">

                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="">إجمالي</label>
                        <input readonly class="inpp sub_total_l" type="text" id="sub_total_l"
                            value="{{ $lens1[0]->sub_total }}" name="sub_total_l[]">

                    </div>
                </td>

                {{-- <td >
                    <div class="form-group">
                        <label for="">الرصيد</label>
                        <input readonly class="inpp"type="text" id="stock_l"
                        value="{{ old('stock', '') }}"  name="stock_l">

                    </div>
                </td> --}}

            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <table>
            <tr class="">
                <td>
                    <div class="form-group">

                        {{-- <a href="{{ route('get_lens',[5,0.50,'s50']) }}">Add</a> --}}
                        <button class="btn btn-primary btn-sm order-prods" id="get_len_r"
                            data-url="{{ route('get_lens', [$id ?? '', $sph ?? '', $cyl ?? '']) }}"
                            data-url-price="{{ route('get_lens_price', [$id ?? '', $sph ?? '', $cyl ?? '']) }}"
                            data-method="get">
                            {{-- data-url="{{ route('admin.sales-invoices.get_lens', [$name ?? '']) }}" data-method="get"> --}}

                            <i class="fa fa-search"></i> بحث

                        </button>
                    </div>
                </td>

                <td>
                    <div class="form-group">
                        <label for="">كود</label>
                        <input readonly class="inpp" type="text" id="lens_diam_id_r"
                            value="{{ $lens1[1]->lens_diam_id }}" name="lens_diam_id_r[]">

                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="">Sph</label>
                        <input readonly class="inpp" type="text" id="sph_1_r"
                            value="{{ $lens1[1]->sph }}" name="sph_1_r[]">

                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="">Cyl</label>
                        <input readonly class="inpp" type="text" id="cyl_1_r"
                            value="{{ $lens1[1]->cyl }}" name="cyl_1_r[]">

                    </div>
                </td>

                <td>
                    <div class="form-group">
                        <label for="">السعر</label>
                        <input readonly class="inpp" type="text" id="price_r"
                            value="{{ $lens1[1]->price }}" name="price_r[]">

                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="">خصم</label>
                        <input readonly class="inpp" type="text" id="disc_r"
                            value="{{ $lens1[1]->disc }}" name="disc_r[]">

                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="">إجمالي</label>
                        <input readonly class="inpp sub_total_r" type="text" id="sub_total_r"
                            value="{{ $lens1[1]->sub_total }}" name="sub_total_r[]">

                    </div>
                </td>

                {{-- <td >
                <div class="form-group">
                    <label for="">الرصيد</label>
                    <input readonly class="inpp"type="text" id="stock_r"
                    value="{{ old('stock', '') }}"  name="stock_r">

                </div>
            </td> --}}

            </tr>
        </table>

    </div>
    <div class="row">
        <div class="col-md-10">
            <table>
                <tr class="d-flex">
                    <td>
                        <div class="card-header">
                            اختر نوع العدسه
                        </div>
                    </td>
                    <td>
                        <input
                            class="form-control  barecode_len {{ $errors->has('barecode_len') ? 'is-invalid' : '' }}"
                            type="text" name="barecode_len" id="barecode"
                            value="{{ old('barecode_len', '') }}">
                    </td>

                    <td class="td2">
                        <select id="len_id" name="len_id[]" class="form-control product">
                            @foreach ($lens as $id => $len)
                                <option value="{{ $id }}"
                                    {{ old('len_id') == $id ? 'selected' : '' }}
                                    data-id="{{ $len->id }}">{{ $len->lens_type }}</option>
                            @endforeach
                        </select>
                    </td>

                </tr>
            </table>
        </div>
    </div>
</div>
