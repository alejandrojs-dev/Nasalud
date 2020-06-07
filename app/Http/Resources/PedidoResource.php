<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PedidoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id'                    => $this->id,
            'numero_pedido'         => $this->numero_pedido,
            'fecha_pedido'          => $this->fecha,
            'total'                 => $this->total_formateado,
            'usuario_pedido'        => $this->usuario_pedido,
            'pizzas_pedido'         => $this->pizzas_pedido
        ];

    }
}
