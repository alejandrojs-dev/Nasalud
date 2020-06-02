<?php
namespace App\Services;

use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use App\Http\Resources\UsuarioResource;
use App\Http\Resources\UsuariosCollection;
use Exception;

class ServicioUsuario
{
    public function guardarUsuario(UsuarioRequest $request)
    {
        try{

            $usuario            = new Usuario();
            $usuario->nombre    = $request->nombre;
            $usuario->email     = $request->email;
            $usuario->password  = $request->password;
            $usuario->save();

            $usuario->susRoles()->attach($request->rol_id);
            $usuario->assignRole($request->rol_id);

            return response()->json([
                'ok'        => true,
                'usuario'   => new UsuarioResource($usuario),
                'message'   => 'Usuario guardado con éxito',
                'code'      => 200
            ]);


        }catch(Exception $e){

            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo registrar al usuario',
                'code'      => 500,
                'error'     => $e->getMessage()
            ], 500);
        }
    }

    public function obtenerUsuario(Usuario $usuario)
    {
        try
        {
            return response()->json([
                'ok'        => true,
                'usuario'   => new UsuarioResource($usuario),
                'code'      => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo obtener al usuario',
                'error'     => $e->getMessage(),
                'code'      => 500
            ], 500);
        }
    }

    public function obtenerTodosUsuarios()
    {
        try
        {
            return response()->json([
                'ok'        => true,
                'usuarios'  => new UsuariosCollection(Usuario::all()),
                'code'      => 200
            ], 200);

        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudieron obtener los usuarios',
                'error'     => $e->getMessage(),
                'code'      => 500
            ], 500);
        }
    }

    public function actualizarUsuario(UsuarioRequest $request, Usuario $usuario)
    {
        try {

            $usuario->update([
                'nombre'    => $request->nombre,
                'email'     => $request->email,
                'password'  => $request->password
            ]);

            $usuario->susRoles()->sync($request->rol_id);

            return response()->json([
                'ok'        => true,
                'usuario'   => new UsuarioResource($usuario),
                'message'   => 'Usuario actualizado con éxito'
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo actualizar el usuario',
                'error'     => $e->getMessage()
            ], 500);
        }
    }

    public function eliminarUsuario(Usuario $usuario)
    {
        try
        {
            $usuario->delete();

            return response()->json([
                'ok'        => true,
                'message'   => 'Usuario eliminado con éxito',
                'code'      => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo eliminar el usuario',
                'error'     => $e->getMessage()
            ], 500);
        }
    }
}
