<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_type' => ['required', 'max:120'],
        ];
    }
    public function messages()
    {
        return[
            'company_type.required' => 'El tipo de empresa del estado es necesario.',
            'company_type.max' => 'El tipo de empresa no debe superar los 120 caracteres',
        ];
    }
}
