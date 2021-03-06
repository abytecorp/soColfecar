<?php

namespace soColfecar\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHotelRequest extends FormRequest
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
            'hotel_name' => ['required', 'max:120']
        ];
    }
    public function messages()
    {
        return[
            'hotel_name.required' => 'Porfavor ingrese el nombre del hotel.',
            'hotel_name.max' => 'El nombre no debe superar los 120 caracteres'
        ];
    }
}
