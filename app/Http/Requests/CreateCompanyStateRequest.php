<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyStateRequest extends FormRequest
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
            'company_state' => ['required', 'max:120', 'unique:company_states'],
            'icon' => ['required'],
        ];
    }
    public function messages()
    {
        return[
            'company_state.required' => 'El nombre del estado es necesario.',
            'company_state.max' => 'El nombre no deben superar los 120 caracteres',
            'company_state.unique' => 'Este estado ya existe',
            'icon.required' => 'Debe seleccionar un icono que ayude a la descripciòn',
        ];
    }
}
