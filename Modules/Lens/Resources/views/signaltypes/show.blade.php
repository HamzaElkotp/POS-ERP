@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.signaltype.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.signaltypes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.signaltype.fields.id') }}
                        </th>
                        <td>
                            {{ $signaltype->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.signaltype.fields.signal_type') }}
                        </th>
                        <td>
                            {{ $signaltype->signal_type }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.signaltypes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#signal_type_lens" role="tab" data-toggle="tab">
                {{ trans('cruds.len.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="signal_type_lens">
            @includeIf('admin.signaltypes.relationships.signalTypeLens', ['lens' => $signaltype->signalTypeLens])
        </div>
    </div>
</div>

@endsection