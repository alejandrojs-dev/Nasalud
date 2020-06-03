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
        $roles_usuario = array();

        foreach($this->susRoles as $rol){
            $permisos_rol_usuario = array();
            foreach($rol->permissions as $permiso){
                $permisos_rol_usuario[] = array(
                    'id'        => $permiso->id,
                    'nombre'    => $permiso->name
                );
            }
            $roles_usuario[] = array(
                'id'        => $rol->id,
                'nombre'    => $rol->name,
                'permisos'  => $permisos_rol_usuario
            );
        }

        return [
            'id'                    => $this->id,
            'nombre'                => $this->nombre,
            'email'                 => $this->email,
            'roles'                 => $roles_usuario,
            'fecha_creacion'        => $this->fecha_creacion,
            'fecha_actualizacion'   => $this->fecha_actualizacion
        ];
    }
}
