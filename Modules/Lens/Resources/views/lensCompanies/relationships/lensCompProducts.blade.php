<div class="m-3">
    @permission('product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
                </a>
            </div>
        </div>
    @endpermission
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-lensCompProducts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.product.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.category') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.supplier') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.price') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.supplier_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.tagzaa_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.gomla_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.quant') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.max_discount') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.sales_incentive') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.type') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.lens_comp') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.photo') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                            <tr data-entry-id="{{ $product->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $product->id ?? '' }}
                                </td>
                                <td>
                                    {{ $product->name ?? '' }}
                                </td>
                                <td>
                                    {{ $product->category->name ?? '' }}
                                </td>
                                <td>
                                    {{ $product->supplier->name ?? '' }}
                                </td>
                                <td>
                                    {{ $product->price ?? '' }}
                                </td>
                                <td>
                                    {{ $product->supplier_price ?? '' }}
                                </td>
                                <td>
                                    {{ $product->tagzaa_price ?? '' }}
                                </td>
                                <td>
                                    {{ $product->gomla_price ?? '' }}
                                </td>
                                <td>
                                    {{ $product->quant ?? '' }}
                                </td>
                                <td>
                                    {{ $product->max_discount ?? '' }}
                                </td>
                                <td>
                                    {{ $product->sales_incentive ?? '' }}
                                </td>
                                <td>
                                    {{ $product->type ?? '' }}
                                </td>
                                <td>
                                    {{ $product->lens_comp->name ?? '' }}
                                </td>
                                <td>
                                    @foreach($product->photo as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @permission('product_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.products.show', $product->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endpermission

                                    @permission('product_update')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.products.edit', $product->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endpermission

                                    @permission('product_delete')
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endpermission

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
@permission('product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products.massDestroy') }}",
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
@endpermission

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-lensCompProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection