@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.sphTo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sph-tos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="sph_to">{{ trans('cruds.sphTo.fields.sph_to') }}</label>
                <input class="form-control {{ $errors->has('sph_to') ? 'is-invalid' : '' }}" type="text" name="sph_to" id="sph_to" value="{{ old('sph_to', '') }}" required>
                @if($errors->has('sph_to'))
                    <span class="text-danger">{{ $errors->first('sph_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sphTo.fields.sph_to_helper') }}</span>
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