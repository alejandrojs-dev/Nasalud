<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Traits\UsuarioMenuTrait;
use App\Models\Permiso;

class Usuario extends Authenticatable implements JWTSubject
{
    use HasRoles, UsuarioMenuTrait;

    protected $table = 'usuarios';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'email', 'password', 'esAdmin'];

    protected $hidden = ['password'];

    //Relaciones
    public function roles()
    {
        return $this->belongsToMany('App\Models\Rol', 'roles_usuarios', 'usuario_id', 'rol_id');
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

    public function getEsAdministradorAttribute()
    {
        return boolval($this->esAdmin);
    }

    public function getSusRolesAttribute()
    {
        return $this->roles->pluck('name')->toArray();
    }

    public function getPermisosAttribute() {
        if($this->es_administrador) {
            return Permiso::pluck('name')->toArray();
        }
        return $this->getAllPermissions()->pluck('name')->toArray();
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
