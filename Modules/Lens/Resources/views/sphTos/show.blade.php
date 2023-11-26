@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sphTo.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sph-tos.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sphTo.fields.id') }}
                        </th>
                        <td>
                            {{ $sphTo->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sphTo.fields.sph_to') }}
                        </th>
                        <td>
                            {{ $sphTo->sph_to }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sph-tos.index') }}">
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
            <a class="nav-link" href="#sph_to_lens" role="tab" data-toggle="tab">
                {{ trans('cruds.len.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="sph_to_lens">
            @includeIf('admin.sphTos.relationships.sphToLens', ['lens' => $sphTo->sphToLens])
        </div>
    </div>
</div>

@endsection