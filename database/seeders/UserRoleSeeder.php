<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $user = User::find(1);
        if ($user) {
            $user->assignRole('superadmin');
        }

        $user = User::find(2);
        if ($user) {
            $user->assignRole('Petugas Monitor Jaringan');
        }

        echo "User roles seeded successfully\n";
    }
}
