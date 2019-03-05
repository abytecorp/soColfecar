<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // permissions Users
        Permission::create([
            'name'          => 'Validar Usuarios',
            'slug'          => 'user.index',
            'description'   => 'Lista y valida todos los usuarios',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de Usuarios',
            'slug'          => 'user.show',
            'description'   => 'Detalle de cada uno de los usuarios',
        ]);
        Permission::create([
            'name'          => 'Creación de Usuarios',
            'slug'          => 'user.create',
            'description'   => 'Crear usuarios en el sistema',
        ]);
        Permission::create([
            'name'          => 'Edición de Usuarios',
            'slug'          => 'user.edit',
            'description'   => 'Editar cualquier dato de usuario en el sistema',
        ]);

        // permissions Roles

        Permission::create([
            'name'          => 'Validar Roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y valida todos los roles',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de Roles',
            'slug'          => 'roles.show',
            'description'   => 'Detalle de cada uno de los roles',
        ]);
        Permission::create([
            'name'          => 'Creación de Roles',
            'slug'          => 'roles.create',
            'description'   => 'Crear roles en el sistema',
        ]);
        Permission::create([
            'name'          => 'Edición de Roles',
            'slug'          => 'roles.edit',
            'description'   => 'Editar cualquier dato de roles en el sistema',
        ]);

        //Afiliations
        Permission::create([
            'name'          => 'Afiliaciones',
            'slug'          => 'roles.edit',
            'description'   => 'Editar cualquier dato de roles en el sistema',
        ]);



  


    }
}
