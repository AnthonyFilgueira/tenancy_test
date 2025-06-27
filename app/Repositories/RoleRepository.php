<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use App\Contracts\RoleRepositoryInterface;


class RoleRepository implements RoleRepositoryInterface
{
    private $role;

    public function __construct(Role $role){
        $this->role = $role;
    }

    public function all()
    {
        return $this->role::all();
    }

    public function find($id)
    {
        return $this->role::findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->role::create($data);
    }
    public function with(array $relations)
    {
        return $this->role::with($relations);
    }

    public function paginate(int $records)
    {
        return $this->role::paginate($records);
    }

    public function syncPermissions(int $roleId, array $permissions)
    {   
        $permissions = is_array($permissions) ? $permissions : [];

        $permissions = collect($permissions ?? [])->map(fn($id) => (int) $id)->toArray();

        $role = $this->find($roleId);

        $role->syncPermissions($permissions);

        return $role;
    }
}