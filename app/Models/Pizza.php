<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $table = 'pizzas';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'tamano', 'precio'];

    protected $hidden = ['pivot'];

    //Relaciones
    public function pedidos()
    {
        return $this->belongsToMany('App\Models\Pedido', 'pedidos_pizzas', 'pizza_id', 'pedido_id');
    }

    //Accesors
    public function getFechaCreacionAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function getFechaActualizacionAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function getPrecioFormateadoAttribute()
    {
        return '$'. number_format($this->precio, 2, '.', '.');
    }

    public function getPrecioDecimalAttribute()
    {
        return (float) $this->precio;
    }

}

