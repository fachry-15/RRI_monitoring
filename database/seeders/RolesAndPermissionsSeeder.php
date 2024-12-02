<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'view users']);

        Permission::create(['name' => 'create task router']);
        Permission::create(['name' => 'delete task router']);
        Permission::create(['name' => 'edit task router']);

        Permission::create(['name' => 'create task monitor logger']);
        Permission::create(['name' => 'delete task monitor logger']);
        Permission::create(['name' => 'edit task monitor logger']);

        Permission::create(['name' => 'accepted work']);
        Permission::create(['name' => 'rejected work']);

        $superadmin = Role::create(['name' => 'superadmin']);
        $superadmin->givePermissionTo(Permission::all());

        $petugasrouter = Role::create(['name' => 'Petugas Monitor Jaringan']);
        $petugasrouter->givePermissionTo(['create task router', 'delete task router', 'edit task router']);

        $petugasmonitorlogger = Role::create(['name' => 'Petugas Monitor Logger']);
        $petugasmonitorlogger->givePermissionTo(['create task monitor logger', 'delete task monitor logger', 'edit task monitor logger']);

        $penanggungjawab = Role::create(['name' => 'Penanggung Jawab']);
        $penanggungjawab->givePermissionTo(['accepted work', 'rejected work']);

        $petugasutama = Role::create(['name' => 'Petugas Utama']);
        $petugasutama->givePermissionTo(['create task router', 'delete task router', 'edit task router', 'create task monitor logger', 'delete task monitor logger', 'edit task monitor logger']);
    }
}
