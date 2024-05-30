@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.data_pengajar.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.dataguruss.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">{{ trans('cruds.data_pengajar.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_pengajar.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_guru">{{ trans('cruds.data_pengajar.fields.nama_guru') }}</label>
                <input class="form-control {{ $errors->has('nama_guru') ? 'is-invalid' : '' }}" type="text" name="nama_guru" id="nama_guru" value="{{ old('nama_guru', '') }}">
                @if($errors->has('nama_guru'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_guru') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_pengajar.fields.nama_guru_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ttl">{{ trans('cruds.data_pengajar.fields.ttl') }}</label>
                <input class="form-control {{ $errors->has('ttl') ? 'is-invalid' : '' }}" type="text" name="ttl" id="ttl" value="{{ old('ttl', '') }}">
                @if($errors->has('ttl'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ttl') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_pengajar.fields.ttl_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.data_pengajar.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_pengajar.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.data_pengajar.fields.riwayat_pendidikan') }}</label>
                <select class="form-control {{ $errors->has('riwayat_pendidikan') ? 'is-invalid' : '' }}" name="riwayat_pendidikan" id="riwayat_pendidikan">
                    <option value disabled {{ old('riwayat_pendidikan', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Dataguru::RIWAYAT_PENDIDIKAN as $key => $label)
                        <option value="{{ $key }}" {{ old('riwayat_pendidikan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('riwayat_pendidikan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('riwayat_pendidikan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_pengajar.fields.riwayat_pendidikan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="universitas">{{ trans('cruds.data_pengajar.fields.universitas') }}</label>
                <input class="form-control {{ $errors->has('universitas') ? 'is-invalid' : '' }}" type="text" name="universitas" id="universitas" value="{{ old('universitas', '') }}" step="1">
                @if($errors->has('universitas'))
                    <div class="invalid-feedback">
                        {{ $errors->first('universitas') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_pengajar.fields.universitas_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="mata_pelajaran">{{ trans('cruds.data_pengajar.fields.mata_pelajaran') }}</label>
                <input class="form-control {{ $errors->has('mata_pelajaran') ? 'is-invalid' : '' }}" type="text" name="mata_pelajaran" id="mata_pelajaran" value="{{ old('mata_pelajaran', '') }}" step="1">
                @if($errors->has('mata_pelajaran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mata_pelajaran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.data_pengajar.fields.universitas_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.dataguruss.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($dataguru) && $dataguru->image)
      var file = {!! json_encode($dataguru->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection
