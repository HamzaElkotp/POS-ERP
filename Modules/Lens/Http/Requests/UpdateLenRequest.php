<?php

namespace Modules\Lens\Http\Requests;

use App\Models\Len;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('update_len');
    }

    public function rules()
    {
        return [
            'lens_type'        => [
                'string',
                'required',
                // 'unique:lens,lens_type,' . request()->route('len')->id,
            ],
            'signal_type_id'   => [
                'required',
                'integer',
            ],
            'lens_diameter_id' => [
                'required',
                'integer',
            ],
            'sph_to_id'        => [
                'required',
                'integer',
            ],
            'allowed_disc'     => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'notes'            => [
                'string',
                'nullable',
            ],
        ];
    }
}