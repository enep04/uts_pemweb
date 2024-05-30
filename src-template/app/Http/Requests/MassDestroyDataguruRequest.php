<?php

namespace App\Http\Requests;

use Gate;
use App\Models\Datagu;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDataguruRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('dataguru_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            // 'ids'   => 'required|array',
            // 'ids.*' => 'exists:dataguruss,id',
        ];
    }
}
