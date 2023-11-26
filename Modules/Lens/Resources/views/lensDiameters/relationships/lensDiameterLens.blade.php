<div class="m-3">
    @can('len_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.lens.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.len.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.len.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-lensDiameterLens">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.len.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.len.fields.lens_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.len.fields.signal_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.len.fields.lens_diameter') }}
                            </th>
                            <th>
                                {{ trans('cruds.len.fields.sph_from') }}
                            </th>
                            <th>
                                {{ trans('cruds.len.fields.sph_to') }}
                            </th>
                            <th>
                                {{ trans('cruds.len.fields.allowed_disc') }}
                            </th>
                            <th>
                                {{ trans('cruds.len.fields.notes') }}
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
                                <td>
                                    {{ $len->signal_type->signal_type ?? '' }}
                                </td>
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
                                <td>
                                    {{ $len->notes ?? '' }}
                                </td>
                                <td>
                                    @can('len_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.lens.show', $len->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('len_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.lens.edit', $len->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('len_delete')
                                        <form action="{{ route('admin.lens.destroy', $len->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('len_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lens.massDestroy') }}",
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
  let table = $('.datatable-lensDiameterLens:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection