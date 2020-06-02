<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RolesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $roles = array();

        foreach ($this->resource as $rol) {
            $roles[] = array(
                'id'                    => $rol->id,
                'nombre'                => $rol->name,
                'fecha_creacion'        => $rol->fecha_creacion,
                'fecha_actualizacion'   => $rol->fecha_actualizacion
            );
        }

        return $roles;
    }
}
