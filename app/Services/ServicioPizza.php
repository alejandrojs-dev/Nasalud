<?php
namespace App\Services;

use App\Models\Pizza;
use App\Http\Requests\PizzaRequest;
use App\Http\Resources\PizzaCollection;
use App\Http\Resources\PizzaResource;
use App\Http\Resources\PizzasCollection;
use Exception;

class ServicioPizza
{
    public function guardarPizza(PizzaRequest $request)
    {
        try{

            $pizza            = new Pizza();
            $pizza->nombre    = $request->nombre;
            $pizza->tamano    = $request->tamano;
            $pizza->precio    = $request->precio;
            $pizza->save();

            return response()->json([
                'ok'        => true,
                'pizza'     => new PizzaResource($pizza),
                'message'   => 'Pizza guardada con éxito',
                'code'      => 200
            ]);


        }catch(Exception $e){

            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo registrar la pizza',
                'code'      => 500,
                'error'     => $e->getMessage()
            ], 500);
        }
    }

    public function obtenerPizza(Pizza $pizza)
    {
        try
        {
            return response()->json([
                'ok'        => true,
                'pizza'     => new PizzaResource($pizza),
                'code'      => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo obtener al pizza',
                'error'     => $e->getMessage(),
                'code'      => 500
            ], 500);
        }
    }

    public function obtenerTodasPizzas()
    {
        try
        {
            return response()->json([
                'ok'        => true,
                'pizzas'    => new PizzasCollection(Pizza::all()),
                'code'      => 200
            ], 200);

        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudieron obtener las pizzas',
                'error'     => $e->getMessage(),
                'code'      => 500
            ], 500);
        }
    }

    public function actualizarPizza(PizzaRequest $request, Pizza $pizza)
    {
        try {

            $pizza->update($request->all());

            return response()->json([
                'ok'        => true,
                'pizza'     => new PizzaResource($pizza),
                'message'   => 'Pizza actualizada con éxito'
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo actualizar la pizza',
                'error'     => $e->getMessage()
            ], 500);
        }
    }

    public function eliminarPizza(Pizza $pizza)
    {
        try
        {
            $pizza->delete();

            return response()->json([
                'ok'        => true,
                'message'   => 'Pizza eliminada con éxito',
                'code'      => 200
            ], 200);
        }
        catch(Exception $e)
        {
            return response()->json([
                'ok'        => false,
                'message'   => 'No se pudo eliminar la pizza',
                'error'     => $e->getMessage()
            ], 500);
        }
    }
}
