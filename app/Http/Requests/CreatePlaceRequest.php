<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlaceRequest extends FormRequest
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
            'place' => ['required', 'max:120'],
            'city_id' => ['required'],
        ];
    }
    public function messages()
    {
        return[
            'place.required' => 'Porfavor ingrese el nombre del lugar.',
            'place.max' => 'El nombre del lugar no debe superar los 120 caracteres.',
            'city_id.required' => 'Debe seleccionar la ciudad',
        ];
    }
}
