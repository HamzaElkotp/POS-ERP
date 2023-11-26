@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.len.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.len.fields.id') }}
                        </th>
                        <td>
                            {{ $len->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.len.fields.lens_type') }}
                        </th>
                        <td>
                            {{ $len->lens_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.len.fields.signal_type') }}
                        </th>
                        <td>
                            {{ $len->signal_type->signal_type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.len.fields.lens_diameter') }}
                        </th>
                        <td>
                            {{ $len->lens_diameter->lens_diameter ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.len.fields.sph_from') }}
                        </th>
                        <td>
                            {{ $len->sph_from->sph_from ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.len.fields.sph_to') }}
                        </th>
                        <td>
                            {{ $len->sph_to->sph_to ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.len.fields.allowed_disc') }}
                        </th>
                        <td>
                            {{ $len->allowed_disc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.len.fields.notes') }}
                        </th>
                        <td>
                            {{ $len->notes }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection