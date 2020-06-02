<?php

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;

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
            $permiso_nuevo_pedido = Permission::create(['name' => 'Nuevo pedido']);
            $permiso_pedidos = Permission::create(['name' => 'Pedidos']);

            //Creando roles
            $admin_rol = Role::create(['name' => 'admin']);
            $admin_rol->givePermissionTo($permiso_nuevo_pedido);
            $admin_rol->givePermissionTo($permiso_pedidos);

            $empleado_rol = Role::create(['name' => 'empleado']);
            $empleado_rol->givePermissionTo($permiso_nuevo_pedido);

            //Creando usuarios y asignamos roles
            $admin = new Usuario();
            $admin->nombre = 'admin';
            $admin->email = 'admin@admin.com';
            $admin->password = 'admin@admin.com';
            $admin->save();

            $admin->assignRole($admin_rol);
            $admin->susRoles()->attach(1);

            $empleado = new Usuario();
            $empleado->nombre = 'soyunempleado';
            $empleado->email = 'empleado@empleado.com';
            $empleado->password = 'empleado@empleado.com';
            $empleado->save();

            $empleado->assignRole($empleado_rol);
            $empleado->susRoles()->attach(2);

        }catch(Exception $e){
            return "Surgió un error al correr el seeder " . $e->getMessage();
        }
    }
}
