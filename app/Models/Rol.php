<?php

namespace App\Models;

use \Spatie\Permission\Models\Role;

class Rol extends Role
{
    protected $table = 'roles';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'guard_name'];

    protected $dates = ['created_at', 'updated_at'];

    protected $hidden = ['pivot'];

    //Accesors
    public function getPermisosAttribute()
    {
        return $this->permissions()->pluck('name');
    }

    public function getFechaCreacionAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function getFechaActualizacionAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }
}
