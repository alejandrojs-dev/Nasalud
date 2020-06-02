<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
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

    public function getTotalFormateadoAttribute()
    {
        return '$'. number_format($this->total, 2, '.', '.');
    }

    //scopes
    public function scopeUsuarioPedido($query)
    {
        return $this->usuario;
    }

    public function scopeCo($query, $pizza_id)
    {
        $pivot = $this->pizzas()->getTable();

        $query->whereHas('pizzas', function ($q) use ($pizza_id, $pivot) {
            $q->where("{$pivot}.id", $pizza_id);
        })->get();

        $query->select('id', 'nombre');
    }
}
