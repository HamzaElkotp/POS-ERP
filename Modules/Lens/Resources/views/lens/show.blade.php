@extends('layouts.app')
<style>
    input {
        max-width: 60px;
    }

    .tbl {
        /* max-width: 600px !important; */
        width: 100%;
        height: 80%; 
        overflow: scroll;
    }
</style>
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" /> --}}

@section('content')
    @can('create_len')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('lens.create') }}">
                    {{ trans('global.add') }} {{ trans('lens::lang.title_singular') }}
                </a>

            </div>
        </div>
    @endcan

    <div class="card">
        <div class="card-header d-flex">
            <h2>
                بيان الكميات للعدسه من نوع : {{ $len->lens_type }}
            </h2>
            <a href="{{ route('lens.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> عرض شاشه
                العدسات</a>

        </div>

        <div class="card-body" dir="ltr">
            <div class="">
                <form method="POST" action="{{ route('lens.store_quant', $len->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div dir="rtl" class="row ">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="sph_from_id">{{ trans('lens::lang.len.fields.sph_from') }}</label>
                                <select class="form-control select2 {{ $errors->has('sph_from') ? 'is-invalid' : '' }}"
                                    name="sph_from_id" id="sph_from_id">
                                    @foreach ($sph_froms as $id => $sph_from)
                                        <option value="{{ $sph_from }}"
                                            {{ old('sph_from_id') == $id ? 'selected' : '' }}>{{ $sph_from }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('sph_from'))
                                    <span class="text-danger">{{ $errors->first('sph_from') }}</span>
                                @endif
                                <span class="help-block">{{ trans('lens::lang.len.fields.sph_from_helper') }}</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="required" for="sph_to_id">{{ trans('lens::lang.len.fields.sph_to') }}</label>
                                <select class="form-control select2 {{ $errors->has('sph_to') ? 'is-invalid' : '' }}"
                                    name="sph_to_id" id="sph_to_id" required>
                                    @foreach ($sph_tos as $id => $sph_to)
                                        <option value="{{ $sph_to }}"
                                            {{ old('sph_to_id') == $id ? 'selected' : '' }}>
                                            {{ $sph_to }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('sph_to'))
                                    <span class="text-danger">{{ $errors->first('sph_to') }}</span>
                                @endif
                                <span class="help-block">{{ trans('lens::lang.len.fields.sph_to_helper') }}</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="sph_from_id"> من Cylender </label>
                                <select class="form-control select2 {{ $errors->has('cyl_n') ? 'is-invalid' : '' }}"
                                    name="cyl_n" id="cyl_n">
                                    @foreach ($cylinders as $id => $cylinder)
                                        <option value="{{ $cylinder }}" {{ old('cyl_n2') == $id ? 'selected' : '' }}>
                                            {{ $cylinder }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="sph_from_id"> إلي Cylender </label>
                                <select class="form-control select2 {{ $errors->has('cyl_n') ? 'is-invalid' : '' }}"
                                    name="cyl_n2" id="cyl_n2">
                                    @foreach ($cylinders as $id => $cylinder)
                                        <option value="{{ $cylinder }}" {{ old('cyl_n2') == $id ? 'selected' : '' }}>
                                            {{ $cylinder }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <label for="">الكميه</label>
                            <input class="form-control" type="number" name="val">
                        </div>
                        <div class="col-md-2 ">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </div>

                    <div class="tbl" >
                    <table class="  table table-bordered table-striped table-hover  datatable datatable-Len">
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

                            @foreach ($len->len_lenses_diams as $key => $len)
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
@endsection
@section('scripts')
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
    </script>
@endsection
