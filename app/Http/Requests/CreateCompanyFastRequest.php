<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyFastRequest extends FormRequest
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
            'bs_name' => ['required', 'max:120', 'unique:companies'],
            'email' => ['required', 'email', 'unique:companies'],
            // 'nit' => ['unique:companies', 'max:9'],
        ];
    }
    public function messages()
    {
        return[
            'bs_name.required' => 'Porfavor ingrese los nombres de la empresa.',
            'bs_name.max' => 'El nombre no deben superar los 120 caracteres',
            'bs_name.unique' => 'Ya existe una empresa registrada con esta razon social.',
            'email.required' => 'Porfavor ingrese el correo electronico',
            'email.email' => 'Ingrese un correo electronico valido',
            'email.unique' => 'Este correo ya pertenece a otra empresa',
            // 'nit.max' => 'El NIT se debe ingresar sin el digito de verificación.',
            // 'nit.unique' => 'ya existe una empresa inscrita con este NIT',
        ];
    }
}
