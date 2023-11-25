@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sphFrom.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sph-froms.update", [$sphFrom->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="sph_from">{{ trans('cruds.sphFrom.fields.sph_from') }}</label>
                <input class="form-control {{ $errors->has('sph_from') ? 'is-invalid' : '' }}" type="text" name="sph_from" id="sph_from" value="{{ old('sph_from', $sphFrom->sph_from) }}" required>
                @if($errors->has('sph_from'))
                    <span class="text-danger">{{ $errors->first('sph_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sphFrom.fields.sph_from_helper') }}</span>
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