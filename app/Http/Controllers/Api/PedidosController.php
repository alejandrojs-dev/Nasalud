<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PedidoRequest;
use App\Models\Pedido;
use App\Services\ServicioPedido;

class PedidosController extends Controller
{
    protected $servicio_pedido;

    public function __construct()
    {
        $this->servicio_pedido = new ServicioPedido();
    }
    /**
     * Enlista todos los pedidos encontrados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->servicio_pedido->obtenerTodosPedidos();
    }

    /**
     * Guarda un nuevo pedido.
     *
     * @param  App\Http\Requests\PedidoRequest;
     * @return \Illuminate\Http\Response
     */
    public function store(PedidoRequest $request)
    {
        return $this->servicio_pedido->guardarPedido($request);
    }

    /**
     * Muestra un pedido.
     *
     * @param  App\Models\Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        return $this->servicio_pedido->obtenerPedido($pedido);
    }

    /**
     * Actualiza un pedido.
     *
     * @param  App\Http\Requests\PedidoRequest;
     * @param  App\Models\Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(PedidoRequest $request, Pedido $pedido)
    {
        return $this->servicio_pedido->actualizarPedido($request, $pedido);
    }

    /**
     * Elimina un pedido.
     *
     * @param  App\Models\Pedido $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        return $this->servicio_pedido->eliminarPedido($pedido);
    }
}
