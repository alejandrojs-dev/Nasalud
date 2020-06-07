<?php

namespace App\Traits;

use App\Models\Menu;
use Tymon\JWTAuth\Facades\JWTAuth;

trait UsuarioMenuTrait
{
    public function getMenuUsuarioAttribute()
    {
        return $this->menuUsuario();
    }

    public function menuUsuario()
    {
        $menus = array();
        $menus_padre = Menu::padre()->orderBy('orden')->get();

        foreach($menus_padre as $menu) {
            if($menu->has('submenus') && $menu->submenus->count() > 0) {
                $agregar = false;
                $submenus_tmp = array();
                $submenus = $menu->submenus()->orderBy('orden')->get();
                foreach($submenus as $submenu) {
                    if((JWTAuth::user()->es_administrador || JWTAuth::user()->hasPermissionTo(str_replace('-', ' ', $submenu->slug)))) {
                        $agregar = true;
                        $submenus_tmp[] = array(
                            'id'            => $submenu->id,
                            'nombre'        => $submenu->nombre,
                            'slug'          => $submenu->slug,
                            'path'          => $menu->path . $submenu->path,
                            'icon'          => $submenu->icon,
                            'habilitado'    => boolval($submenu->habilitado),
                            'orden'         => $submenu->orden
                        );
                    }
                }

                if($agregar) {
                    $menus[] = array(
                        'id'            => $menu->id,
                        'nombre'        => $menu->nombre,
                        'slug'          => $menu->slug,
                        'path'          => $menu->path,
                        'icon'          => $menu->icon,
                        'habilitado'    => boolval($menu->habilitado),
                        'orden'         => $menu->orden,
                        'submenus'      => $submenus_tmp
                    );
                }
            }
        }
        return $menus;
    }
}
