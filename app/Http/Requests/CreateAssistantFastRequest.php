<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssistantFastRequest extends FormRequest
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
            'names' => ['required', 'max:120'],
            'last_names' => ['required', 'max:120'],
            'email' => ['required', 'email', 'unique:assistants'],
            'id_city' => ['required'],
            'id_company' => ['required'],
        ];
    }
    public function messages()
    {
        return[
            'names.required' => 'Porfavor ingrese los nombres del asistente.',
            'names.max' => 'los nombres no deben superar los 120 caracteres',
            'last_names.required' => 'Porfavor ingrese los nombres del asistente.',
            'last_names.max' => 'los nombres no deben superar los 120 caracteres',
            'email.required' => 'Porfavor ingrese el correo electronico',
            'email.email' => 'Ingrese un correo electronico valido',
            'email.unique' => 'Este correo ya pertenece a otro asistente',
            'id_city.required' => 'Debe registrar la ciudad.',
            'id_company.required' => 'Debe seleccionar una empresa.',
        ];
    }
}
