<?php

namespace App\Traits;
use App\Models\Pedido;
use App\Models\Usuario;

trait PizzasPedidosTrait
{
    public function getPizzasPedidoAttribute()
    {
        return $this->obtenerPizzasPedido();
    }

    public function obtenerPizzasPedido()
    {
        $pizzas_pedido = array();
        $pedidos = Pedido::orderBy('numero_pedido')->get();

        foreach($pedidos as $pedido) {
            if($pedido->pizzas->count() > 0) {
                $pizzas = $pedido->pizzas()->orderBy('id')->get();
                foreach($pizzas as $pizza) {
                    $pizzas_pedido[] = array(
                        'id'        => $pizza->id,
                        'nombre'    => $pizza->nombre,
                        'tamano'    => $pizza->tamano,
                        'precio'    => $pizza->precio_formateado
                    );
                }
            }
        }
        return $pizzas_pedido;
    }
}
