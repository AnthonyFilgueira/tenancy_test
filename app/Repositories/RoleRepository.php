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
        return Role::create($data);
    }
    public function with(array $relations)
    {
        return $this->role::with($relations);
    }

    public function paginate(int $records)
    {
        return $this->role::paginate($records);
    }
    public function syncPermissions(int $id, array $data)
    {
        $role = $this->find($id);

        $role->syncPermissions($data);

        return $role;
    }
}