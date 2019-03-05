<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'slug' => ['unique'],
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Porfavor ingrese un nombre para este Role.',
            'name.max' => 'El nombre de el Role no debe superar los 160 caracteres',
            'slug.unique' => 'Este slug o ruta ya existe en el sistema de roles',
        ];
    }
}
