<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\TenantStoreRequest;

class TenantController extends Controller
{

    public function index()
    {
        $tenants = Tenant::all();

        return view('tenants.index', ['tenants' => $tenants]);
    }

    public function store(TenantStoreRequest $request)
    {
        $tenant = Tenant::create(['id' => $request->input('tenant_id')]);

        $tenant->domains()->create(['domain' => $tenant->id . '.localhost']);

        tenancy()->initialize($tenant);

            //Creacion de Roles
            $role_admin = Role::create(['name' => 'admin']);
            $role_agent = Role::create(['name' => 'agent']);
            //Creacion de permisos
            $permission_create_user = Permission::create(['name' => 'create_user']);
            $permission_destroy_user = Permission::create(['name' => 'destroy_user']);
            $permission_create = Permission::create(['name' => 'create_task']);
            $permission_update = Permission::create(['name' => 'update_task']);
            $permission_destroy = Permission::create(['name' => 'destroy_task']);
            //Asignacion de permisos a rol admin
            $role_admin->syncPermissions([$permission_create_user->id, $permission_destroy_user->id]);
            //Asignacion de permisos a rol admin
            $role_agent->syncPermissions([$permission_create->id, $permission_update->id, $permission_destroy->id]);
            //creacion de usuario admin
            $admin = User::create([
                'name' => 'Admin ' . $tenant->id,
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
            ]);
            $admin->assignRole('admin');
            //creacion de usuario agent
            $agent = User::create([
                'name' => 'Agent ' . $tenant->id,
                'email' => 'agent@agent.com',
                'password' => Hash::make('password'),
            ]);
            $agent->assignRole('agent');

        tenancy()->end();


        return redirect(route('tenants.index'));

    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect(route('tenants.index'));

    }
}
