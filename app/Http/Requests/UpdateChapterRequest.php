<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChapterRequest extends FormRequest
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
            'chapter' => ['required','max:120'],
            'date_init' => ['required'],
            'date_end' => ['required'],
            'banner' => ['required'],
        ];
    }
    public function messages()
    {
        return[
            'chapter.required' => 'Debe ingresar el nombre o titulo del capitulo',
            'chapter.max' => 'El nombre o titulo del capitulo no debe contener mas de 120 caracteres',
            'date_init.required' => 'Debe ingresar la fecha y hora de inicio del capitulo.',
            'date_end.required' => 'Debe ingresar la fecha y hora final del capitulo.',
            'banner.required' => 'Debe agregar una imagen para establecer el banner del capitulo',
            // 'banner.max' => 'El tamaño del archivo no debe superar el peso de 500kb.',
            // 'banner.image' => 'El archivo debe ser una imagen en formato PNG',
        ];
    }
}
