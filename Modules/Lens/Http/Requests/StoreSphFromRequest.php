<?php

namespace Modules\Lens\Http\Requests;

use App\Models\SphFrom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSphFromRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('create_sph_from');
    }

    public function rules()
    {
        return [
            'sph_from' => [
                'string',
                'required',
                'unique:sph_froms',
            ],
        ];
    }
}
