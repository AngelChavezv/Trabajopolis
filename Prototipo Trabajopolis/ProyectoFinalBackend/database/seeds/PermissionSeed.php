<?php

use App\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolAdministrador = Role::create(['name'=>'administrador']);
        $rolEmpleado = Role::create(['name'=>'empleado']);
        $rolSolicitante = Role::create(['name'=>'Solicitante']);

  /* PERMISOS CATEGORIAS */

        $categoriacrear = Permission::create(['name'=>'Crear Categoria']);
        $categoriaeditar = Permission::create(['name'=>'Editar Categoria']);
        $categoriaeliminar = Permission::create(['name'=>'Eliminar Categoria']);
        $categoriaver = Permission::create(['name' =>'Mostrar Categoria']);
        $categoriadetalle =Permission::create(['name'=>'ver Detalle Categoria']);

        /* PERMISOS CURRICULUM */
        $curriculumcrear = Permission::create(['name'=>'Crear Curriculum']);
        $curriculumeditar = Permission::create(['name'=>'Editar Curriculum']);
        $curriculumeliminar = Permission::create(['name'=>'Eliminar Curriculum']);
        $curriculumver = Permission::create(['name' =>'Mostrar Curriculum']);
        $curriculumdetalle =Permission::create(['name'=>'ver Detalle Curriculum']);
        $curriculumverSolicitante = Permission::create(['name'=>'Mostrar Curriculum Solicitante']);

        /* PERMISOS CIUDAD */
        $ciudadcrear = Permission::create(['name'=>'Crear Ciudad']);
        $ciudadeditar = Permission::create(['name'=>'Editar Ciudad']);
        $ciudadeliminar = Permission::create(['name'=>'Eliminar Ciudad']);
        $ciudadver = Permission::create(['name' =>'Mostrar Ciudad']);
        $ciudaddetalle =Permission::create(['name'=>'ver Detalle Ciudad']);


        /* PERMISOS EMPLEO */
        $empleocrear = Permission::create(['name'=>'Crear Empleo']);
        $empleoeditar = Permission::create(['name'=>'Editar Empleo']);
        $empleoeliminar = Permission::create(['name'=>'Eliminar Empleo']);
        $empleover = Permission::create(['name' =>'Mostrar Empleo']);
        $empleodetalle =Permission::create(['name'=>'ver Detalle Empleo']);
        $empleocreadorver = Permission::create(['name'=>'Mostrar Empleo Creador']);
        $empleocreadorSolicitante = Permission::create(['name'=>'Mostrar Empleo Solicitante']);

        /* PERMISOS USUARIOS */
        $usercrear = Permission::create(['name'=>'Crear Usuario']);
        $usereditar = Permission::create(['name'=>'Editar Usuario']);
        $usereliminar = Permission::create(['name'=>'Eliminar Usuario']);
        $userver = Permission::create(['name' =>'Mostrar Usuario']);
        $userdetalle =Permission::create(['name'=>'ver Detalle Usuario']);
        $userrol =Permission::create(['name'=>'Asignar Rol a Usuario']);
        $usercontrasena =Permission::create(['name'=>'cambiar contrasena']);



        /* PERMISOS CATEGORIAS-EMPLEO */
        $categoriaempleocrear = Permission::create(['name'=>'Crear CategoriaEmpleo']);
        $categoriaempleoeditar = Permission::create(['name'=>'Editar CategoriaEmpleo']);
        $categoriaempleoeliminar = Permission::create(['name'=>'Eliminar CategoriaEmpleo']);
        $categoriaempleover = Permission::create(['name' =>'Mostrar CategoriaEmpleo']);
        $categoriaempleodetalle =Permission::create(['name'=>'ver Detalle CategoriaEmpleo']);


        /* PERMISOS EMPLEO-USER */
        $empleousercrear = Permission::create(['name'=>'Crear EmpleoUser']);

        $rolSolicitante->givePermissionTo($empleousercrear);
        $rolSolicitante->givePermissionTo($curriculumverSolicitante);
        $rolSolicitante->givePermissionTo($curriculumcrear);
        $rolSolicitante->givePermissionTo($curriculumeliminar);
        $rolSolicitante->givePermissionTo($curriculumdetalle);
        $rolSolicitante->givePermissionTo($curriculumeditar);
        $rolSolicitante->givePermissionTo($empleodetalle);
        $rolSolicitante->givePermissionTo($empleocreadorSolicitante);

        $rolEmpleado->givePermissionTo($empleocreadorver);
        $rolEmpleado->givePermissionTo($empleoeliminar);
        $rolEmpleado->givePermissionTo($empleoeditar);
        $rolEmpleado->givePermissionTo($empleodetalle);
        $rolEmpleado->givePermissionTo($empleocrear);

        $rolAdministrador->givePermissionTo($categoriacrear);
        $rolAdministrador->givePermissionTo($categoriaeditar);
        $rolAdministrador->givePermissionTo($categoriaeliminar);
        $rolAdministrador->givePermissionTo($categoriadetalle);
        $rolAdministrador->givePermissionTo($categoriaver);
        $rolAdministrador->givePermissionTo($curriculumdetalle);
        $rolAdministrador->givePermissionTo($curriculumver);
        $rolAdministrador->givePermissionTo($ciudadcrear);
        $rolAdministrador->givePermissionTo($ciudadeditar);
        $rolAdministrador->givePermissionTo($ciudadeliminar);
        $rolAdministrador->givePermissionTo($ciudaddetalle);
        $rolAdministrador->givePermissionTo($ciudadver);
        $rolAdministrador->givePermissionTo($empleocrear);
        $rolAdministrador->givePermissionTo($empleoeditar);
        $rolAdministrador->givePermissionTo($empleoeliminar);
        $rolAdministrador->givePermissionTo($empleodetalle);
        $rolAdministrador->givePermissionTo($empleover);
        $rolAdministrador->givePermissionTo($usercrear);
        $rolAdministrador->givePermissionTo($usereditar);
        $rolAdministrador->givePermissionTo($usereliminar);
        $rolAdministrador->givePermissionTo($userver);
        $rolAdministrador->givePermissionTo($usercontrasena);
        $rolAdministrador->givePermissionTo($userrol);
        $rolAdministrador->givePermissionTo($userdetalle);
        $rolAdministrador->givePermissionTo($categoriaempleocrear);
        $rolAdministrador->givePermissionTo($categoriaempleodetalle);
        $rolAdministrador->givePermissionTo($categoriaempleoeditar);
        $rolAdministrador->givePermissionTo($categoriaempleoeliminar);
        $rolAdministrador->givePermissionTo($categoriaempleover);

       $Admin = User::create([
          'name' => 'admin',
           'email' =>'administrador@gmail.com',
           'password'=>Hash::make('123456789'),

       ]);
       $Admin->assignRole($rolAdministrador);

        $Empleado = User::create([
            'name' => 'empleado',
            'email' =>'empleado@gmail.com',
            'password'=>Hash::make('123456789'),

        ]);

        $Empleado->assignRole($rolEmpleado);


        $Solicitante = User::create([
            'name' => 'solicitante',
            'email' =>'solicitante@gmail.com',
            'password'=>Hash::make('123456789'),

        ]);

        $Solicitante->assignRole($rolSolicitante);



    }
}
