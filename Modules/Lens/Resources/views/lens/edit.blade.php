@extends('layouts.app')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('lens::len.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("lens.update", [$len->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="lens_type">{{ trans('lens::len.fields.lens_type') }}</label>
                <input class="form-control {{ $errors->has('lens_type') ? 'is-invalid' : '' }}" type="text" name="lens_type" id="lens_type" value="{{ old('lens_type', $len->lens_type) }}" required>
                @if($errors->has('lens_type'))
                    <span class="text-danger">{{ $errors->first('lens_type') }}</span>
                @endif
                <span class="help-block">{{ trans('lens::len.fields.lens_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="signal_type_id">{{ trans('lens::len.fields.signal_type') }}</label>
                <select class="form-control select2 {{ $errors->has('signal_type') ? 'is-invalid' : '' }}" name="signal_type_id" id="signal_type_id" required>
                    @foreach($signal_types as $id => $signal_type)
                        <option value="{{ $id }}" {{ (old('signal_type_id') ? old('signal_type_id') : $len->signal_type->id ?? '') == $id ? 'selected' : '' }}>{{ $signal_type }}</option>
                    @endforeach
                </select>
                @if($errors->has('signal_type'))
                    <span class="text-danger">{{ $errors->first('signal_type') }}</span>
                @endif
                <span class="help-block">{{ trans('lens::len.fields.signal_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lens_diameter_id">{{ trans('lens::len.fields.lens_diameter') }}</label>
                <select class="form-control select2 {{ $errors->has('lens_diameter') ? 'is-invalid' : '' }}" name="lens_diameter_id" id="lens_diameter_id" required>
                    @foreach($lens_diameters as $id => $lens_diameter)
                        <option value="{{ $id }}" {{ (old('lens_diameter_id') ? old('lens_diameter_id') : $len->lens_diameter->id ?? '') == $id ? 'selected' : '' }}>{{ $lens_diameter }}</option>
                    @endforeach
                </select>
                @if($errors->has('lens_diameter'))
                    <span class="text-danger">{{ $errors->first('lens_diameter') }}</span>
                @endif
                <span class="help-block">{{ trans('lens::len.fields.lens_diameter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sph_from_id">{{ trans('lens::len.fields.sph_from') }}</label>
                <select class="form-control select2 {{ $errors->has('sph_from') ? 'is-invalid' : '' }}" name="sph_from_id" id="sph_from_id">
                    @foreach($sph_froms as $id => $sph_from)
                        <option value="{{ $id }}" {{ (old('sph_from_id') ? old('sph_from_id') : $len->sph_from_id ?? '') == $id ? 'selected' : '' }}>{{ $sph_from }}</option>
                    @endforeach
                </select>
                @if($errors->has('sph_from'))
                    <span class="text-danger">{{ $errors->first('sph_from') }}</span>
                @endif
                <span class="help-block">{{ trans('lens::len.fields.sph_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sph_to_id">{{ trans('lens::len.fields.sph_to') }}</label>
                <select class="form-control select2 {{ $errors->has('sph_to') ? 'is-invalid' : '' }}" name="sph_to_id" id="sph_to_id" required>
                    @foreach($sph_tos as $id => $sph_to)
                        <option value="{{ $id }}" {{ (old('sph_to_id') ? old('sph_to_id') : $len->sph_to_id ?? '') == $id ? 'selected' : '' }}>{{ $sph_to }}</option>
                    @endforeach
                </select>
                @if($errors->has('sph_to'))
                    <span class="text-danger">{{ $errors->first('sph_to') }}</span>
                @endif
                <span class="help-block">{{ trans('lens::len.fields.sph_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="allowed_disc">{{ trans('lens::len.fields.allowed_disc') }}</label>
                <input class="form-control {{ $errors->has('allowed_disc') ? 'is-invalid' : '' }}" type="number" name="allowed_disc" id="allowed_disc" value="{{ old('allowed_disc', $len->allowed_disc) }}" step="0.01" max="100">
                @if($errors->has('allowed_disc'))
                    <span class="text-danger">{{ $errors->first('allowed_disc') }}</span>
                @endif
                <span class="help-block">{{ trans('lens::len.fields.allowed_disc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="notes">{{ trans('lens::len.fields.notes') }}</label>
                <input class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', $len->notes) }}">
                @if($errors->has('notes'))
                    <span class="text-danger">{{ $errors->first('notes') }}</span>
                @endif
                <span class="help-block">{{ trans('lens::len.fields.notes_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection