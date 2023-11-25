@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lensDiameter.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lens-diameters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lensDiameter.fields.id') }}
                        </th>
                        <td>
                            {{ $lensDiameter->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lensDiameter.fields.lens_diameter') }}
                        </th>
                        <td>
                            {{ $lensDiameter->lens_diameter }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lens-diameters.index') }}">
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
            <a class="nav-link" href="#lens_diameter_lens" role="tab" data-toggle="tab">
                {{ trans('cruds.len.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="lens_diameter_lens">
            @includeIf('admin.lensDiameters.relationships.lensDiameterLens', ['lens' => $lensDiameter->lensDiameterLens])
        </div>
    </div>
</div>

@endsection