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
            'numero_pedido' => 'required|integer|unique:pedidos,numero_pedido',
            'fecha'         => 'required|date',
            'total'         => 'required|numeric',
            'usuario_id'    => 'required|exists:usuarios,id|integer',
            'pizzas_pedido' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'numero_pedido.required'    => 'El número de pedido es obligatorio',
            'numero_pedido.integer'     => 'El número de pedido debe ser un valor entero',
            'numero_pedido.unique'      => 'Ya existe una orden con ese número de pedido',
            'fecha.required'            => 'La fecha del pedido es obligatoria',
            'fecha.date'                => 'La fecha no tiene un formato válido',
            'total.required'            => 'El total del pedido es obligatorio',
            'total.numeric'             => 'El total debe ser un valor numérico',
            'usuario_id.required'       => 'El usuario del pedido es obligatorio',
            'usuario_id.exists'         => 'El usuario del pedido no se encuestra en existencia',
            'pizzas_pedido.required'    => 'El pedido debe de contener al menos una pizza',
            'pizzas_pedido.array'       => 'El valor de las pizzas del pedido debe ser un arreglo'
        ];
    }
}
