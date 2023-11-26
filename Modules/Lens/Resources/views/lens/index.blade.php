@extends('layouts.app')

@section('content')

@can('create_lenses')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('lens.create')}}">
                @lang('global.add')  @lang('lens::lang.title_singular') 
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
     @lang('lens::lang.lens')   
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Len">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            الكود
                        </th>
                        <th>
                           نوع العدسه 
                        </th>
                        {{-- <th>
                            @lang('lens::len.fields.signal_type') 
                        </th> --}}
                        <th>
                            قر العدسه
                        </th>
                        <th>
                            من spher 
                        </th>
                        <th>
                        الي spher 
                        </th>
                        <th>
                            الخصم المسموح
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lens as $key => $len)
                        <tr data-entry-id="{{ $len->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $len->id ?? '' }}
                            </td>
                            <td>
                                {{ $len->lens_type ?? '' }}
                            </td>
                            {{-- <td>
                                {{ $len->signal_type->signal_type ?? '' }}
                            </td> --}}
                            <td>
                                {{ $len->lens_diameter->lens_diameter ?? '' }}
                            </td>
                            <td>
                                {{ $len->sph_from->sph_from ?? '' }}
                            </td>
                            <td>
                                {{ $len->sph_to->sph_to ?? '' }}
                            </td>
                            <td>
                                {{ $len->allowed_disc ?? '' }}
                            </td>

                            <td class="d-flex">
                                {{-- @permission('update_lenses') --}}
                                    <a class="btn butn btn-xs btn-primary" href="{{ route('lens.show', $len->id) }}">
                                        عرض الكميات
                                    </a>
                                    <a class="btn butn btn-xs btn-primary" href="{{ route('lens.show4', $len->id) }}">
                                          عرض الكميات 1
                                    </a>

                                    <a class="btn butn btn-xs btn-primary" href="{{ route('lens.show2', $len->id) }}">
                                        عرض اسعار البيع
                                    </a>
                                    <a class="btn butn btn-xs btn-primary" href="{{ route('lens.show3', $len->id) }}">
                                        عرض اسعار التكلفه
                                    </a>
                                {{-- @endpermission --}}

                                <a class="btn butn btn-xs btn-success" href="{{ route('lens.show5', $len->id) }}">
                                طباعه الكميات
                            </a>

                                {{-- @can('update_lenses')
                                    <a class="btn btn-xs btn-info" href="{{ route('lens.edit', $len->id) }}">
                                        @lang('global.edit') 
                                    </a>
                                @endcan --}}

                                {{-- @permission('delete_lenses') --}}
                                    <form action="{{ route('lens.destroy', $len->id) }}" method="POST" onsubmit="return confirm('@lang('global.areYouSure') ');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="حذف ">
                                    </form>
                                {{-- @endpermission --}}

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Len:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
