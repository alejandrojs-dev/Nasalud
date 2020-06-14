<?php
namespace App\Services;

use App\Models\Pedido;
use App\Http\Requests\PedidoRequest;
use App\Http\Resources\PedidoResource;
use App\Http\Resources\PedidosCollection;
use Exception;

class ServicioPedido
{
    public function guardarPedido(PedidoRequest $request)
    {
        try{

            $pedido                     = new Pedido();
            $pedido->numero_pedido      = $request->numero_pedido;
            $pedido->fecha              = $request->fecha;
            $pedido->total              = $request->total;
            $pedido->usuario_id         = $request->usuario_id;
            $pedido->save();

            $pedido->pizzas()->attach($request->pizzas_pedido);

            return response()->json([
                'ok'        => true,
                'pedido'    => new PedidoResource($pedido),
                'message'   => 'Pedido guardado con éxito',
                'code'      => 200
            ]);


        }catch(Exception $e){

            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo registrar el pedido',
                'code'      => 500,
                'error'     => $e->getMessage()
            ], 500);
        }
    }

    public function obtenerPedido(Pedido $pedido)
    {
        try
        {
            return response()->json([
                'ok'        => true,
                'pedido'    => new PedidoResource($pedido),
                'code'      => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo obtener el pedido',
                'error'     => $e->getMessage(),
                'code'      => 500
            ], 500);
        }
    }

    public function obtenerTodosPedidos()
    {
        try
        {
            $pedidos = Pedido::orderBy('numero_pedido')->paginate(5);

            return response()->json([
                'ok'        => true,
                'paginacion' => [
                    'total'             => $pedidos->total(),
                    'paginaActual'      => $pedidos->currentPage(),
                    'porPagina'         => $pedidos->perPage(),
                    'ultimaPagina'      => $pedidos->lastPage(),
                    'from'              => $pedidos->firstItem(),
                    'to'                => $pedidos->lastPage()
                ],
                'pedidos'   => new PedidosCollection($pedidos),
                'code'      => 200
            ], 200);

        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudieron obtener los pedidos',
                'error'     => $e->getMessage(),
                'code'      => 500
            ], 500);
        }
    }

    public function actualizarPedido(PedidoRequest $request, Pedido $pedido)
    {
        try {

            $pedido->update([
                'numero_pedido'     => $request->numero_pedido,
                'fecha'             => $request->fecha,
                'total'             => $request->total,
                'usuario_id'        => $request->usuario_id
            ]);

            $pedido->pizzas()->sync($request->pizzas);

            return response()->json([
                'ok'        => true,
                'pedido'    => new PedidoResource($pedido),
                'message'   => 'Pedido actualizado con éxito'
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo actualizar el pedido',
                'error'     => $e->getMessage()
            ], 500);
        }
    }

    public function eliminarPedido(Pedido $pedido)
    {
        try
        {
            $pedido->delete();

            return response()->json([
                'ok'        => true,
                'message'   => 'Pedido eliminado con éxito',
                'code'      => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo eliminar el pedido',
                'error'     => $e->getMessage()
            ], 500);
        }
    }
}
