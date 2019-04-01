<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyTypeRequest extends FormRequest
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
            'company_type' => ['required', 'max:120', 'unique:company_types']
        ];
    }
    public function messages()
    {
        return[
            'company_type.required' => 'El nombre del tipo de empresa es necesario.',
            'company_type.max' => 'El nombre no deben superar los 120 caracteres',
            'company_type.unique' => 'Este tipo de empresa ya existe',
        ];
    }
}
