<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PizzaResource extends JsonResource
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
            'nombre'                => $this->nombre,
            'tamano'                => $this->tamano,
            'precio'                => $this->precio_formateado,
            'precio_sin_formato'    => $this->precio_decimal,
            'fecha_creacion'        => $this->fecha_creacion,
            'fecha_actualizacion'   => $this->fecha_actualizacion
        ];
    }
}
