<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => ['required', 'max:160'],
            'last_name' => ['required', 'max:160'],
            'email' => ['required', 'email', 'unique:users'],
            'user_type' => ['required'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required_with:password']
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Porfavor ingrese los nombres del usuario.',
            'name.max' => 'Los nombres no deben superar los 160 caracteres',
            'last_name.required' => 'Porfavor ingrese los apellidos del usuario.',
            'last_name.max' => 'Los apellidos no deben superar los 160 caracteres',
            'email.required' => 'Porfavor ingrese el correo electronico',
            'email.email' => 'Ingrese un correo electronico valido',
            'email.unique' => 'Este correo ya pertenece a otro usuario',
            'user_type.required' => 'Debe seleccionar el perfil de usuario',
            'password.required' => 'Debe registrar un password',
            'password.confirmed' => 'La confirmación del password no coincide.'
        ];
    }
}
