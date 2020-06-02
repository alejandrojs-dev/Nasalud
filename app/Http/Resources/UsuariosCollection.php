<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsuariosCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $usuarios = array();

        foreach ($this->resource as $usuario) {
            $roles_usuario = array();
            foreach($usuario->susRoles as $rol){
                $roles_usuario[] = array(
                    'id'        => $rol->id,
                    'nombre'    => $rol->name
                );
            }

            $usuarios[] = array(
                'id'                    => $usuario->id,
                'nombre'                => $usuario->nombre,
                'email'                 => $usuario->email,
                'roles'                 => $roles_usuario,
                'fecha_creacion'        => $usuario->fecha_creacion,
                'fecha_actualizacion'   => $usuario->fecha_actualizacion
            );
        }

        return $usuarios;
    }
}
