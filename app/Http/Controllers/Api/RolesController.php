<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolRequest;
use App\Services\ServicioRol;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    protected $servicio_rol;

    public function __construct()
    {
        $this->servicio_rol = new ServicioRol();
    }
    /**
     * Enlista los roles encontrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->servicio_rol->obtenerTodosRoles();
    }

    /**
     * Guarda un nuevo rol.
     *
     * @param  App\Http\Requests\RolRequest;
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        return $this->servicio_rol->guardarRol($request);
    }

    /**
     * Muestra un rol.
     *
     * @param  Spatie\Permission\Models\Role;
     * @return \Illuminate\Http\Response
     */
    public function show(Role $rol)
    {
        return $this->servicio_rol->obtenerRol($rol);
    }

    /**
     * Actualiza un rol.
     *
     * @param  App\Http\Requests\RolRequest;
     * @param  Spatie\Permission\Models\Role;
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, Role $rol)
    {
        return $this->servicio_rol->actualizarRol($request, $rol);
    }

    /**
     * Elimina un rol.
     *
     * @param  Spatie\Permission\Models\Role;
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $rol)
    {
        return $this->servicio_rol->eliminarRol($rol);
    }
}
