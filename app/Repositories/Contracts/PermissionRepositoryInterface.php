<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface PermissionRepositoryInterface
{
	public function all();
	public function find(int $id);
	public function create(array $data);
	public function update(int $id, array $data);
	public function delete(int $id);
	public function paginate(int $records);
}
