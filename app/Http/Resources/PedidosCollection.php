<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PedidosCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pedidos = array();

        foreach ($this->resource as $pedido) {
            $pedidos[] = array(
                'id'                => $pedido->id,
                'numero_pedido'     => $pedido->numero_pedido,
                'total'             => $pedido->total_formateado,
                'usuario_pedido'    => $pedido->usuario,
                'pizzas_pedido'     => $pedido->pizzas_pedido
            );
        }
        return $pedidos;
    }
}
