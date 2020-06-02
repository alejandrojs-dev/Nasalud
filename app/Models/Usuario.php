<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Authenticatable implements JWTSubject
{
    use HasRoles;

    protected $table = 'usuarios';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'email', 'password'];

    protected $hidden = ['password'];

    //Relaciones
    public function susRoles()
    {
        return $this->belongsToMany('Spatie\Permission\Models\Role', 'roles_usuarios', 'usuario_id', 'rol_id');
    }

    public function pedidosDadosDeAlta()
    {
        return $this->hasMany('App\Models\Pedido');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    //Accesors
    public function getFechaCreacionAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function getFechaActualizacionAttribute()
    {
        return $this->updated_at->format('Y-m-d');
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
