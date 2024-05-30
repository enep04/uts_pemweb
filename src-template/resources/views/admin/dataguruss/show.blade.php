@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dataguru.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dataguruss.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.id') }}
                        </th>
                        <td>
                            {{ $dataguru->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.image') }}
                        </th>
                        <td>
                            @if($dataguru->image)
                                <a href="{{ $dataguru->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $dataguru->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.nama_guru') }}
                        </th>
                        <td>
                            {{ $dataguru->nama_guru }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.description') }}
                        </th>
                        <td>
                            {{ $dataguru->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.ttl') }}
                        </th>
                        <td>
                            {{ $dataguru->ttl }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.description') }}
                        </th>
                        <td>
                            {{ $dataguru->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.riwayat_pendidikan') }}
                        </th>
                        <td>
                            {{ $dataguru->riwayat_pendidikan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.universitas') }}
                        </th>
                        <td>
                            {{ $dataguru->universitas }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.riwayat_pendidikan') }}
                        </th>
                        <td>
                            {{ App\Models\Dataguru::RIWAYAT_PENDIDIKAN[$dataguru->riwayat_pendidikan] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.dataguruss.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection