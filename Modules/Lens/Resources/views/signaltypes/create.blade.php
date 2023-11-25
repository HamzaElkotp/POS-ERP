@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.signaltype.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.signaltypes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="signal_type">{{ trans('cruds.signaltype.fields.signal_type') }}</label>
                <input class="form-control {{ $errors->has('signal_type') ? 'is-invalid' : '' }}" type="text" name="signal_type" id="signal_type" value="{{ old('signal_type', '') }}" required>
                @if($errors->has('signal_type'))
                    <span class="text-danger">{{ $errors->first('signal_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.signaltype.fields.signal_type_helper') }}</span>
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