<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
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
            'email'                 => $this->email,
            'roles'                 => $this->sus_roles,
            'permisos'              => $this->permisos,
            'fecha_creacion'        => $this->fecha_creacion,
            'fecha_actualizacion'   => $this->fecha_actualizacion,
            'menus'                 => $this->menu_usuario
        ];
    }
}
