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
            $pizzas_pedido = array();
            foreach($pedido->pizzas as $pizza){
                $pizzas_pedido[] = array(
                    'id'        => $pizza->id,
                    'nombre'    => $pizza->nombre,
                    'tamano'    => $pizza->tamano,
                    'precio'    => $pizza->precio_formateado
                );
            }

            $pedidos[] = array(
                'id'                => $pedido->id,
                'numero_pedido'     => $pedido->numero_pedido,
                'total'             => $pedido->total_formateado,
                'usuario_pedido'    => $pedido->usuario,
                'pizzas_pedido'     => $pizzas_pedido
            );
        }

        return $pedidos;
    }
}
