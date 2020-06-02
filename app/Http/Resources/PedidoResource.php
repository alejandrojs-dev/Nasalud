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
        $pizzas_pedido = array();

        foreach($this->pizzas as $pizza){
            $pizzas_pedido[] = array(
                'id'        => $pizza->id,
                'nombre'    => $pizza->nombre,
                'tamano'    => $pizza->tamano,
                'precio'    => $pizza->precio_formateado
            );
        }

        return [
            'id'                    => $this->id,
            'numero_pedido'         => $this->numero_pedido,
            'fecha_pedido'          => $this->fecha,
            'total'                 => $this->total_formateado,
            'usuario_pedido'        => $this->usuario,
            'pizzas_pedido'         => $pizzas_pedido
        ];
    }
}
