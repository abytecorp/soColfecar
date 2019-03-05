<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
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
            'event' => ['required', 'max:120'],
            'id_event_type' => ['required'],
            // 'date_init' => ['required'],
            // 'date_end' => ['required'],
            //'banner' => ['required','max:500','image'],
        ];
    }
    public function messages()
    {
        return[
            'event.required' => 'Es necesario el nombre del evento para poder continuar.',
            'event.max' => 'El nombre del evento no debe superar los 120 caracteres',
            'id_event_type.required' => 'Debe seleccionar el tipo de evento.',
            'date_init.required' => 'Debe seleccionar la fecha de inicio.',
            'date_end.required' => 'Debe seleccionar la fecha final.',
            // 'banner.required' => 'Debe seleccionar una imagen para generar el evento.',
            // 'banner.max' => 'El tamaño del archivo no debe superar el peso de 500kb.',
            // 'banner.image' => 'El archivo debe ser una imajen en formato jpg',

        ];
    }
}
