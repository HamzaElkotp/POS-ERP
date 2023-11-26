<?php

namespace Modules\Lens\Http\Requests;

use App\Models\LensDiameter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLensDiameterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('update_lens_diameter');
    }

    public function rules()
    {
        return [
            'lens_diameter' => [
                'string',
                'required',
                'unique:lens_diameters,lens_diameter,' . request()->route('lens_diameter')->id,
            ],
        ];
    }
}
