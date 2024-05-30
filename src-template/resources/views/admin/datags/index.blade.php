@extends('layouts.admin')
@section('content')
@can('dataguru_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.datags.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.data_pengajar.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.data_pengajar.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Dataguru">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.nama_guru') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.ttl') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.riwayat_pendidikan') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.universitas') }}
                        </th>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.mata_pelajaran') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ds as $key => $d)
                        <tr data-entry-id="{{ $d->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $d->id ?? '' }}
                            </td>
                            <td>
                                @if($d->image)
                                    <a href="{{ $d->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $d->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $d->nama_guru ?? '' }}
                            </td>
                            <td>
                                {{ $d->ttl ?? '' }}
                            </td>
                            <td>
                                {{ $d->description ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Datagu::RIWAYAT_PENDIDIKAN[$d->riwayat_pendidikan] ?? '' }}
                            </td>
                            <td>
                                {{ $d->universitas ?? '' }}
                            </td>
                            <td>
                                {{ $d->mata_pelajaran ?? '' }}
                            </td>
                            <td>
                                @can('dataguru_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.datags.show', $d->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('dataguru_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.datags.edit', $d->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('dataguru_delete')
                                    <form action="{{ route('admin.datags.destroy', $d->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @method('DELETE')
                                        @csrf
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
@can('dataguru_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.datags.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-Dataguru:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
