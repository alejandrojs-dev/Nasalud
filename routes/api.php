<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function () {
    Route::post('login', 'Api\AutenticacionController@login');
    Route::get('logout', 'Api\AutenticacionController@logout')->middleware('jwt.verify');
    Route::group(['middleware' => ['jwt.verify', 'role:admin']], function () {
        Route::apiResource('roles', 'Api\RolesController');
        Route::apiResource('usuarios', 'Api\UsuariosController');
        Route::apiResource('pizzas', 'Api\PizzasController');
    });
    Route::group(['middleware' => ['jwt.verify', 'role:admin|empleado', 'permission:Nuevo pedido']], function () {
        Route::post('pedidos', 'Api\PedidosController@store');
        Route::delete('pedidos', 'Api\PedidosController@delete');
        Route::put('pedidos', 'Api\PedidosController@update');
    });
    Route::group(['middleware' => ['jwt.verify', 'role:admin', 'permission:Pedidos']], function () {
        Route::get('pedidos', 'Api\PedidosController@index');
        Route::get('pedidos/{pedido}', 'Api\PedidosController@show');
    });
});
