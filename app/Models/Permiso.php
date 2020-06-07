<?php

namespace App\Models;

use \Spatie\Permission\Models\Permission;

class Permiso extends Permission
{
    protected $table = 'permisos';

    protected $primaryKey = 'id';

    protected $fillable = ['name','guard_name'];

    protected $dates = ['created_at','updated_at'];

    protected $hidden = ['pivot'];

    //Accesors
    public function getFechaCreacionAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function getFechaActualizacionAttribute()
    {
        return $this->updated_at->format('Y-m-d');
    }
}
