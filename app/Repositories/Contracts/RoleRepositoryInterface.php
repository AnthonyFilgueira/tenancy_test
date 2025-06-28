<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface RoleRepositoryInterface
{
	public function all();
	public function find($id);
	public function create(array $data);
	public function update(int $id, array $data);
	public function delete(int $id);
	public function with(array $relations);
	public function paginate(int $records);
}
