<?php

namespace App\Repositories\Contracts;

interface RoleRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function with(array $relations);
    public function paginate(int $records);
}
