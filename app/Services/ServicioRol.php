<?php
namespace App\Services;

use Spatie\Permission\Models\Role;
use App\Http\Requests\RolRequest;
use App\Http\Resources\RolesCollection;
use App\Http\Resources\RolResource;
use Exception;

class ServicioRol
{
    public function guardarRol(RolRequest $request)
    {
        try{

            $rol = Role::create(['name' => $request->name]);

            return response()->json([
                'ok'        => true,
                'rol'       => new RolResource($rol),
                'message'   => 'Rol guardado con éxito',
                'code'      => 200
            ]);


        }catch(Exception $e){

            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo guardar el rol',
                'code'      => 500,
                'error'     => $e->getMessage()
            ], 500);
        }
    }

    public function obtenerRol(Role $rol)
    {
        try
        {
            return response()->json([
                'ok'        => true,
                'rol'       => new RolResource($rol),
                'code'      => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo obtener el rol',
                'error'     => $e->getMessage(),
                'code'      => 500
            ], 500);
        }
    }

    public function obtenerTodosRoles()
    {
        try
        {
            return response()->json([
                'ok'        => true,
                'roles'     => new RolesCollection(Role::all()),
                'code'      => 200
            ], 200);

        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudieron obtener los roles',
                'error'     => $e->getMessage(),
                'code'      => 500
            ], 500);
        }
    }

    public function actualizarRol(RolRequest $request, Role $rol)
    {
        try {

            $rol->update(['name' => $request->nombre]);

            return response()->json([
                'ok'        => true,
                'rol'       => new RolResource($rol),
                'message'   => 'Rol actualizado con éxito'
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo actualizar el rol',
                'error'     => $e->getMessage()
            ], 500);
        }
    }

    public function eliminarRol(Role $rol)
    {
        try
        {
            $rol->delete();

            return response()->json([
                'ok'        => true,
                'message'   => 'Rol eliminado con éxito',
                'code'      => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo eliminar el rol',
                'error'     => $e->getMessage()
            ], 500);
        }
    }
}
