<?php

namespace Modules\Lens\Http\Requests;

use App\Models\Signaltype;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSignaltypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('update_signal_type');
    }

    public function rules()
    {
        return [
            'signal_type' => [
                'string',
                'required',
                'unique:signaltypes,signal_type,' . request()->route('signaltype')->id,
            ],
        ];
    }
}
