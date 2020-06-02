<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PizzaRequest;
use App\Models\Pizza;
use App\Services\ServicioPizza;

class PizzasController extends Controller
{
    protected $servicio_pizza;

    public function __construct()
    {
        $this->servicio_pizza = new ServicioPizza();
    }
    /**
     * Enlista todas las pizzas encontradas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->servicio_pizza->obtenerTodasPizzas();
    }

    /**
     * Guarda una nueva pizza.
     *
     * @param  App\Http\Requests\PizzaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PizzaRequest $request)
    {
        return $this->servicio_pizza->guardarPizza($request);
    }

    /**
     * Muestra una pizza.
     *
     * @param  App\Models\Pizza $pizza
     * @return \Illuminate\Http\Response
     */
    public function show(Pizza $pizza)
    {
        return $this->servicio_pizza->obtenerPizza($pizza);
    }

    /**
     * Actualiza una pizza.
     *
     * @param  App\Http\Requests\PizzaRequest $request
     * @param  App\Models\Pizza $pizza
     * @return \Illuminate\Http\Response
     */
    public function update(PizzaRequest $request, Pizza $pizza)
    {
        return $this->servicio_pizza->actualizarPizza($request, $pizza);
    }

    /**
     * Elimina una pizza.
     *
     * @param  App\Models\Pizza $pizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pizza $pizza)
    {
        return $this->servicio_pizza->eliminarPizza($pizza);
    }
}
