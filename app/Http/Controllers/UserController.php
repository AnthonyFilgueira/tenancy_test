<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

final class UserController extends Controller
{
	public function index()
	{
		$users = User::latest()->paginate(10);

		return view('users.index', compact('users'));
	}

	public function create()
	{
		$roles = Role::pluck('name', 'id');
		return view('users.create', compact('roles'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:6',
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		$user->assignRole(Role::findById($request->role)->name);

		return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
	}

	public function edit(User $user)
	{
		$roles = Role::pluck('name', 'id');
		$userRole = $user->roles->pluck('id')->first();

		return view('users.edit', compact('user', 'roles', 'userRole'));
	}

	public function update(Request $request, User $user)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => "required|email|unique:users,email,{$user->id}",
			'role' => 'required|exists:roles,id',
		]);

		$user->update([
			'name' => $request->name,
			'email' => $request->email,
		]);

		$user->syncRoles([Role::findById($request->role)->name]);

		return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
	}

	public function destroy(User $user)
	{
		$user->delete();
		return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
	}
}
