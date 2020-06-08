<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = str_replace('Bearer ', '' , $request->header('Authorization'));

        try {

            JWTAuth::setToken($token);

            $usuario = JWTAuth::authenticate($token);

            if(!$usuario) {
                return response()->json(['ok' => false, 'message' => 'Usuario no encontrado', 'code' => 404], 404);
            }

        } catch (JWTException $e) {

            if ($e instanceof TokenInvalidException) {

                return response()->json(['ok' => false, 'message' => 'Token inválido', 'code' => 400], 400);

            }else if ($e instanceof TokenExpiredException) {

                return response()->json(['ok' => false, 'message' => 'Token expirado', 'code' => 403], 403);

            }else {
                return response()->json(['ok' => false, 'message' => 'Token de autorización no encontrado', 'code' => 404], 404);
            }
        }

        return $next($request, $usuario);
    }
}
