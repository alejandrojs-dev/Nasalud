<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\ServicioAutenticacion;
use Illuminate\Http\Request;

class AutenticacionController extends Controller
{
    protected $servicio_autenticacion;

    public function __construct()
    {
        $this->servicio_autenticacion = new ServicioAutenticacion();
    }
    /**
     * Método login para autenticar usuarios.
     *
     * @param  App\Http\Requests\LoginRequest;
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        return $this->servicio_autenticacion->login($request);
    }

    /**
     * Desloguear usuarios de la aplicación.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        return $this->servicio_autenticacion->logout();
    }

    /**
     * Verifica token.
     *
     * @param  App\Http\Requests\Request;
     * @return \Illuminate\Http\Response
     */
    public function verificarToken($token)
    {
       return $this->servicio_autenticacion->verificarToken($token);
    }
}
