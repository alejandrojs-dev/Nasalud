<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permiso;

class Menu extends Model
{
    protected $table = 'menus';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'slug',
        'path',
        'icono',
        'orden',
        'habilitado',
        'parent_id'
    ];

    protected $appends = [
        'permisos',
    ];

    public function getPermisosAttribute()
    {
        if($this->parent_id){
            return Permiso::where('name','LIKE','%'. str_replace('-', ' ' , $this->slug .'%'))->pluck('name')->toArray();
        }
    }

    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function nodoPadre()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function scopePadre($query)
    {
        return $query->where('parent_id', null);
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
}
