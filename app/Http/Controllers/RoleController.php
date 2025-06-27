<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create(['name' => $request->name]);
        
        $permissions = collect($request->permissions ?? [])->map(fn($id) => (int) $id)->toArray();

        $role->syncPermissions(is_array($permissions) ? $permissions : []);

        return redirect()->route('roles.index')->with('success', 'Role creado correctamente');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $role->load('permissions');
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        
        $role->update(['name' => $request->name]);
        $permissions = collect($request->permissions ?? [])->map(fn($id) => (int) $id)->toArray();
        $role->syncPermissions(is_array($permissions) ? $permissions : []);

        return redirect()->route('roles.index')->with('success', 'Role actualizado correctamente');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role eliminado');
    }
}
