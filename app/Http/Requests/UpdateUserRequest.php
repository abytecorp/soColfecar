<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:160'],
            'last_name' => ['required', 'max:160'],
            'user_type' => ['required'],
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Porfavor ingrese los nombres del usuario.',
            'name.max' => 'Los nombres no deben superar los 160 caracteres',
            'last_name.required' => 'Porfavor ingrese los apellidos del usuario.',
            'last_name.max' => 'Los apellidos no deben superar los 160 caracteres',
            'email.email' => 'Ingrese un correo electronico valido',
            'email.unique' => 'Este correo ya pertenece a otro usuario',
            'user_type.required' => 'Debe seleccionar el perfil de usuario',
        ];
    }
}
