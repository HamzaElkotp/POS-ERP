<?php

namespace Modules\Lens\Http\Requests;

use App\Models\SphFrom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSphFromRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('update_sph_from');
    }

    public function rules()
    {
        return [
            'sph_from' => [
                'string',
                'required',
                'unique:sph_froms,sph_from,' . request()->route('sph_from')->id,
            ],
        ];
    }
}
