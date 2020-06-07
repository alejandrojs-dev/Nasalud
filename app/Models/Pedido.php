<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PizzasPedidosTrait;

class Pedido extends Model
{
    use PizzasPedidosTrait;

    protected $table = 'pedidos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'numero_pedido',
        'fecha',
        'total',
        'usuario_id'
    ];

    //Relaciones
    public function pizzas()
    {
        return $this->belongsToMany('App\Models\Pizza', 'pedidos_pizzas', 'pedido_id', 'pizza_id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario')->select('id', 'nombre');
    }

    //Accesors
    public function getUsuarioPedidoAttribute($query)
    {
        return $this->usuario;
    }

    public function getTotalFormateadoAttribute()
    {
        return '$'. number_format($this->total, 2, '.', '.');
    }
}
