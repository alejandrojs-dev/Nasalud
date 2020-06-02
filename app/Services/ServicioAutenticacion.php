<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UsuarioResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ServicioAutenticacion
{
    public function login(LoginRequest $request)
    {
        $credenciales = $request->only('email', 'password');

        try{

            $token = JWTAuth::attempt($credenciales);

            if(!$token){

                return response()->json([
                    'ok'        => false,
                    'message'   => 'Credenciales inválidas',
                    'code'      => 401
                ], 401);
            }

            $usuario = JWTAuth::user();

            return response()->json([
                'ok'        => true,
                'token'     => $token,
                'message'   => 'Te has logueado correctamente',
                'usuario'   => new UsuarioResource($usuario),
                'code'      => 200
            ], 200);

        }catch(JWTException $e){

            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo generar el token',
                'error'     => $e->getMessage(),
                'code'      => 500
            ], 500);

        }
    }

    public function logout()
    {
        $token = JWTAuth::getToken();

        try {

            JWTAuth::invalidate($token);

            return response()->json([
                'ok'        => true,
                'message'   => 'Te has deslogueado correctamente',
                'code'      => 200
            ], 200);

        } catch (JWTException $e) {

            return response()->json([
                'ok'        => false,
                'message'   => 'El usuario no puede desloguearse',
                'error'     => $e->getMessage(),
                'code'      => 422
            ], 422);

        }
    }
}
