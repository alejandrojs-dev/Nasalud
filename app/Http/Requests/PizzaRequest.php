<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PizzaRequest extends FormRequest
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
            'nombre'    => 'required',
            'tamano'    => 'required',
            'precio'    => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'       => 'El nombre de la pizza es obligatorio',
            'tamano.required'       => 'El tamaño de la pizza es obligatorio',
            'precio.required'       => 'El precio de la pizza es obligatorio',
            'precio.numeric'        => 'El valor del precio debe ser un valor numérico'
        ];
    }
}
