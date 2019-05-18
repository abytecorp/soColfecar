<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventTypeRequest extends FormRequest
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
            'event_type' => ['required', 'max:120'],
            'icon' => ['required'],
        ];
    }
    public function messages()
    {
        return[
            'event_type.required' => 'El nombre del tipo es necesario.',
            'event_type.max' => 'El nombre no deben superar los 120 caracteres',
            //'company_state.unique' => 'Este estado ya existe',
            'icon.required' => 'Debe seleccionar un icono que ayude a la descripciòn',
        ];
    }
}