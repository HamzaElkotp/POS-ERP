<?php

namespace Modules\Lens\Http\Requests;

use App\Models\LensCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLensCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('create_lens_company');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:lens_companies',
            ],
        ];
    }
}
