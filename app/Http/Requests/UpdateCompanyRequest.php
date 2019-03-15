<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'bs_name' => ['required', 'max:160'],
            'nit' => ['required', 'max:9', 'min:9'],
            'id_city' => ['required'],
        ];
    }
    public function messages()
    {
        return[
            'bs_name.required' => 'Porfavor ingrese el nombre comercial de la empresa.',
            'bs_name.max' => 'Los nombres no deben superar los 160 caracteres',
            'nit.required' => 'Para esta actualizacion es necesario el NIT de la empresa',
            'nit.max' => 'El nit debe contener maximo 9 digitos',
            'nit.min' => 'El nit debe contener minimo 9 digitos',
            'id_city.required' => 'Debe seleccionar una ciudad'
            // 'email.unique' => 'Este correo ya pertenece a otro usuario',
            // 'user_type.required' => 'Debe seleccionar el perfil de usuario',
        ];
    }
}
