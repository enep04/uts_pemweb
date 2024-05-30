@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.data.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.datags.index') }}">
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
                            {{ $data->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.image') }}
                        </th>
                        <td>
                            @if($data->image)
                                <a href="{{ $data->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $data->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.nama_guru') }}
                        </th>
                        <td>
                            {{ $data->nama_guru }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.description') }}
                        </th>
                        <td>
                            {{ $data->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.ttl') }}
                        </th>
                        <td>
                            {{ $data->ttl }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.description') }}
                        </th>
                        <td>
                            {{ $data->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.riwayat_pendidikan') }}
                        </th>
                        <td>
                            {{ $data->riwayat_pendidikan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.universitas') }}
                        </th>
                        <td>
                            {{ $data->universitas }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.data_pengajar.fields.riwayat_pendidikan') }}
                        </th>
                        <td>
                            {{ App\Models\Dataguru::RIWAYAT_PENDIDIKAN[$data->riwayat_pendidikan] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.datags.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection