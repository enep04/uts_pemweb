<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Datagu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDataguruRequest;
use App\Http\Requests\UpdateDataguruRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyDataguruRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DatagController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('dataguru_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ds = Datagu::with(['media'])->get();

        return view('admin.datags.index', compact('ds'));
    }

    public function create()
    {
        abort_if(Gate::denies('dataguru_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.datags.create');
    }

    public function store(StoreDataguruRequest $request)
    {
        $data = Datagu::create($request->all());

        if ($request->input('image', false)) {
            $data->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $data->id]);
        }

        return redirect()->route('admin.datags.index');
    }

    public function edit(Datagu $data)
    {
        abort_if(Gate::denies('dataguru_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.datags.edit', compact('data'));
    }

    public function update(UpdateDataguruRequest $request, Datagu $data)
    {
        $data->update($request->all());
    
        if ($request->input('image', false)) {
            if (! $data->image || $request->input('image') !== $data->image->file_name) {
                if ($data->image) {
                    $data->image->delete();
                }
                $data->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($data->image) {
            $data->image->delete();
        }
    
        return redirect()->route('admin.datags.index');
    }

    public function show(Datagu $data)
    {
        abort_if(Gate::denies('dataguru_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.datags.show', compact('data'));
    }

    public function destroy(Datagu $data)
    {
        abort_if(Gate::denies('dataguru_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataguruRequest $request)
    {
        $data = Datagu::find(request('ids'));

        foreach ($data as $data) {
            $data->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('dataguru_create') && Gate::denies('dataguru_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Datagu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
