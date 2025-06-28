<?php

declare(strict_types=1);

namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use App\Repositories\Contracts\PermissionRepositoryInterface;

final class PermissionRepository implements PermissionRepositoryInterface
{
	private $permission;

	public function __construct(Permission $permission)
	{
		$this->permission = $permission;
	}
	public function all()
	{
		return $this->permission::all();
	}

	public function find(int $id)
	{
		return $this->permission::findOrFail($id);
	}

	public function create(array $data)
	{
		return $this->permission::create($data);
	}

	public function update(int $id, array $data)
	{
		$permission = $this->find($id);
		$permission->update($data);
		return $permission;
	}

	public function delete($id)
	{
		$permission = $this->find($id);
		return $permission->delete();
	}

	public function paginate(int $records)
	{
		return $this->permission::paginate($records);
	}
}
