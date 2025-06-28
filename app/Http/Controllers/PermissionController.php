<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(
        private readonly PermissionRepositoryInterface $permissionRepository
    ) {}
    
    public function index()
    {
        $permissions = $this->permissionRepository->paginate(10);

        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        $this->permissionRepository->create(['name' => $request->name]);
        
        return redirect()->route('permissions.index')->with('success', 'Permiso creado');
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update(['name' => $request->name]);
        return redirect()->route('permissions.index')->with('success', 'Permiso actualizado');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permiso eliminado');
    }
}
