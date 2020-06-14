<?php

use App\Models\Usuario;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use App\Models\Permiso;
use Spatie\Permission\PermissionRegistrar;
use App\Models\Rol;
use Illuminate\Support\Facades\Log;

class ConfigPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{

            app()[PermissionRegistrar::class]->forgetCachedPermissions();

            //Create permissions
            $permiso_nuevo_pedido = Permiso::create(['name' => 'nuevo pedido']);
            $permiso_ver_pedidos = Permiso::create(['name' => 'ver pedidos']);

            //Creando roles
            $admin_rol = Rol::create(['name' => 'admin']);
            $admin_rol->givePermissionTo($permiso_nuevo_pedido);
            $admin_rol->givePermissionTo($permiso_ver_pedidos);

            $empleado_rol = Rol::create(['name' => 'empleado']);
            $empleado_rol->givePermissionTo($permiso_nuevo_pedido);

            //Creando usuarios y asignamos roles
            $admin = new Usuario();
            $admin->nombre = 'admin';
            $admin->email = 'admin@admin.com';
            $admin->password = 'admin@admin.com';
            $admin->esAdmin = true;
            $admin->save();
            $admin->assignRole($admin_rol);

            $empleado = new Usuario();
            $empleado->nombre = 'soyunempleado';
            $empleado->email = 'empleado@empleado.com';
            $empleado->password = 'empleado@empleado.com';
            $empleado->esAdmin = false;
            $empleado->save();
            $empleado->assignRole($empleado_rol);

            //Creacion de menu
            $menu_pedidos = new Menu();
            $menu_pedidos->nombre = 'Pedidos';
            $menu_pedidos->slug = 'menu-pedidos';
            $menu_pedidos->path = '/pedidos';
            $menu_pedidos->orden = 0;
            $menu_pedidos->icono = 'gear-fill';
            $menu_pedidos->save();

            $menu_nuevo_pedido = new Menu();
            $menu_nuevo_pedido->nombre = 'Nuevo pedido';
            $menu_nuevo_pedido->slug = 'nuevo-pedido';
            $menu_nuevo_pedido->path = '/nuevoPedido';
            $menu_nuevo_pedido->orden = 1;
            $menu_nuevo_pedido->parent_id = 1;
            $menu_nuevo_pedido->icono = 'box-seam';
            $menu_nuevo_pedido->save();

            $menu_ver_pedidos = new Menu();
            $menu_ver_pedidos->nombre = 'Ver pedidos';
            $menu_ver_pedidos->slug = 'ver-pedidos';
            $menu_ver_pedidos->path = '/ver';
            $menu_ver_pedidos->orden = 2;
            $menu_ver_pedidos->parent_id = 1;
            $menu_ver_pedidos->icono = 'table';
            $menu_ver_pedidos->save();

        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }
}
