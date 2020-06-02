<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PizzasCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pizzas = array();

        foreach ($this->resource as $pizza) {
            $pizzas[] = array(
                'id'                    => $pizza->id,
                'nombre'                => $pizza->nombre,
                'tamano'                => $pizza->tamano,
                'precio'                => $pizza->precio_formateado,
                'fecha_creacion'        => $pizza->fecha_creacion,
                'fecha_actualizacion'   => $pizza->fecha_actualizacion
            );
        }

        return $pizzas;
    }
}
