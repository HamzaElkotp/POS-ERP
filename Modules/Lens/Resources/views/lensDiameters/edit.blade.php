@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.lensDiameter.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lens-diameters.update", [$lensDiameter->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="lens_diameter">{{ trans('cruds.lensDiameter.fields.lens_diameter') }}</label>
                <input class="form-control {{ $errors->has('lens_diameter') ? 'is-invalid' : '' }}" type="text" name="lens_diameter" id="lens_diameter" value="{{ old('lens_diameter', $lensDiameter->lens_diameter) }}" required>
                @if($errors->has('lens_diameter'))
                    <span class="text-danger">{{ $errors->first('lens_diameter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.lensDiameter.fields.lens_diameter_helper') }}</span>
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