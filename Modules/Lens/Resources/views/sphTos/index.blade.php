@extends('layouts.admin')

@section('content')
@can('create_sph_to')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sph-tos.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.sphTo.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sphTo.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SphTo">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.sphTo.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.sphTo.fields.sph_to') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sphTos as $key => $sphTo)
                        <tr data-entry-id="{{ $sphTo->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $sphTo->id ?? '' }}
                            </td>
                            <td>
                                {{ $sphTo->sph_to ?? '' }}
                            </td>
                            <td>
                                @can('show_sph_to')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sph-tos.show', $sphTo->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('update_sph_to')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sph-tos.edit', $sphTo->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('delete_sph_to')
                                    <form action="{{ route('admin.sph-tos.destroy', $sphTo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

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
@can('delete_sph_to')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sph-tos.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-SphTo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
