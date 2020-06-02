<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use App\Services\ServicioUsuario;

class UsuariosController extends Controller
{
    protected $servicio_usuario;

    public function __construct()
    {
        $this->servicio_usuario = new ServicioUsuario();
    }
    /**
     * Enlista todos los usuarios encontrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->servicio_usuario->obtenerTodosUsuarios();
    }

    /**
     * Guarda un usuario.
     *
     * @param  App\Http\Requests\UsuarioRequest;
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        return $this->servicio_usuario->guardarUsuario($request);
    }

    /**
     * Muestra un usuario.
     *
     * @param  App\Models\Usuario;
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return $this->servicio_usuario->obtenerUsuario($usuario);
    }

    /**
     * Actualiza un usuario.
     *
     * @param  App\Http\Requests\UsuarioRequest;
     * @param  App\Models\Usuario;
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        return $this->servicio_usuario->actualizarUsuario($request, $usuario);
    }

    /**
     * Elimina un usuario.
     *
     * @param  App\Models\Usuario;
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        return $this->servicio_usuario->eliminarUsuario($usuario);
    }
}
