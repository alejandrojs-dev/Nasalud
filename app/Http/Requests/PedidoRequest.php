<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
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
            'numero_pedido' => 'required|integer',
            'fecha'         => 'required|date',
            'total'         => 'required|numeric',
            'usuario_id'    => 'required|exists:usuarios,id|integer',
            'pizzas'        => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'numero_pedido.required'    => 'El número de pedido es obligatorio',
            'numero_pedido.integer'     => 'El número de pedido debe ser un valor entero',
            'fecha.required'            => 'La fecha del pedido es obligatoria',
            'fecha.date'                => 'La fecha no tiene un formato válido',
            'total.required'            => 'El total del pedido es obligatorio',
            'total.numeric'             => 'El total debe ser un valor numérico',
            'usuario_id.required'       => 'El usuario del pedido es obligatorio',
            'usuario_id.exists'         => 'El usuario del pedido no se encuestra en existencia',
            'pizzas.required'           => 'La pizza del pedido es obligatorio',
            'pizzas.array'              => 'El valor de las pizzas del pedido debe ser un arreglo'
        ];
    }
}
