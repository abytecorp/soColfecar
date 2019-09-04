<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlanRequest extends FormRequest
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
            'plan' => ['required', 'max:120'],
            'id_event' => ['required'],
            'invitation_type' => ['required'],
            //'id_company_state' => ['required'],
            // 'pl_desc' => ['required'],
            // 'price' => ['required'],

        ];
    }
    public function messages()
    {
        return[
            'plan.required' => 'Porfavor ingrese el nombre del plan.',
            'plan.max' => 'El nombre del plan no debe superar los 120 caracteres.',
            //'pl_desc.required' => 'Debe ingresar la descripcion del plan',
            'id_event.required' => 'Debe seleccionar un evento',
            'invitation_type.required' => 'Es necesario seleccionar el tipo de invitacion.'
            // 'id_company_state.required' => 'Debe asiganr un tipo de beneficio',
            // 'price.required' => ['Debe asignar un valor al plan'],
        ];
    }
}
