<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssistantRequest extends FormRequest
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
            'id_city' => ['required'],
            'id_company' => ['required'],
            'email' => ['required', 'unique:assistants,email,'.$this->assistant['id']],
        ];
    }
    public function messages()
    {
        return[
            'names.required' => 'Porfavor ingrese los nombres del asistente.',
            'names.max' => 'Los nombres no deben superar los 120 caracteres',
            'last_names.required' => 'Porfavor ingrese los nombres del asistente.',
            'last_names.max' => 'Los nombres no deben superar los 120 caracteres',
            'id_city.required' => 'Debe registrar la ciudad.',
            'id_company.required' => 'Debe seleccionar una empresa.',
            'email.required' => 'Debe asignar un Em@il',
            'email.unique' => 'Este email ya esta asignado a otro asistente'
        ];
    }
}
