<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function all()
    {
        return $this->user::all();
    }

    public function find($id)
    {
        return $this->user::findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->user::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        return $user->delete();
    }

    public function paginate(int $records)
    {
        return $this->user::paginate($records);
    }
}