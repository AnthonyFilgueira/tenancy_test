<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\RoleRepositoryInterface;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use Spatie\Permission\Models\Role;

final class RoleController extends Controller
{
	public function __construct(
		private readonly RoleRepositoryInterface $roleRepository,
		private readonly PermissionRepositoryInterface $permissionRepository
	) {}

	public function index()
	{
		$roles = $this->roleRepository->with(['permissions'])->paginate(10);

		return view('roles.index', compact('roles'));
	}

	public function create()
	{
		$permissions = $this->permissionRepository->all();
		return view('roles.create', compact('permissions'));
	}

	public function store(StoreRoleRequest $request)
	{
		$role = $this->roleRepository->create(['name' => $request->name]);

		$this->roleRepository->syncPermissions($role->id, $request->permissions);

		return redirect()->route('roles.index')->with('success', 'Role creado correctamente');
	}

	public function edit(Role $role)
	{
		$permissions = $this->permissionRepository->all();

		$role->load('permissions');

		return view('roles.edit', compact('role', 'permissions'));
	}

	public function update(UpdateRoleRequest $request, Role $role)
	{
		$role = $this->roleRepository->update($role->id, ['name' => $request->name]);

		$this->roleRepository->syncPermissions($role->id, $request->permissions);

		return redirect()->route('roles.index')->with('success', 'Role actualizado correctamente');
	}

	public function destroy(Role $role)
	{
		$this->roleRepository->delete($role->id);

		return redirect()->route('roles.index')->with('success', 'Role eliminado');
	}
}
