<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CentralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Creacion de Roles
        $role = Role::create(['name' => 'super_admin']);
        //Creacion de permisos
        $permission_create = Permission::create(['name' => 'create_tenant']);
        $permission_destroy = Permission::create(['name' => 'destroy_tenant']);
        //Asignacion de permisos a rol
         $role->syncPermissions([$permission_create->id,$permission_destroy->id]);
        //creacion de usuario super admin
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('super_admin');
        //Creacion de Tenants
        $tenant = Tenant::create(['id' => 'empresa1']);
        $tenant->domains()->create(['domain' => $tenant->id.'.localhost']);

        $tenant2 = Tenant::create(['id' => 'empresa2']);
        $tenant2->domains()->create(['domain' => $tenant2->id.'.localhost']);
    }
}
