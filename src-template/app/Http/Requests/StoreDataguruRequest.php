<?php

namespace App\Http\Requests;

use Gate;
use App\Models\Datagu;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;

class StoreDataguruRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dataguru_create');
    }

    public function rules()
    {
        return [
            // 'name' => [
            //     'string',
            //     'nullable',
            // ],
            // 'description' => [
            //     'string',
            //     'nullable',
            // ],
            // 'stock' => [
            //     'nullable',
            //     'integer',
            //     'min:-2147483648',
            //     'max:2147483647',
            // ],
        ];
    }
}
