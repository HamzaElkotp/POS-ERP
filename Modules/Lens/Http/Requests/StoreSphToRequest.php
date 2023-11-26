<?php

namespace Modules\Lens\Http\Requests;

use App\Models\SphTo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSphToRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('create_sph_to');
    }

    public function rules()
    {
        return [
            'sph_to' => [
                'string',
                'required',
                'unique:sph_tos',
            ],
        ];
    }
}
