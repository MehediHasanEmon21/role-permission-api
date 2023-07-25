<?php

namespace App\Repositories;

use App\Interfaces\CrudInterfaces;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements CrudInterfaces
{
    public function getAll(array $filterData): LengthAwarePaginator
    {
        $perPage = $filterData['perPage'] ?? 10;

        return User::with(['roles:id,name'])->orderBy('id', 'desc')->paginate($perPage);
    }

    public function create(array $data): ?User
    {

        $data['password'] = $this->makeHashPassword($data['password']);

        $roles = $data['role_id'];

        unset($data['role_id']);

        $user = User::create($data);

        if (! $user) {
            throw new Exception('User creating Error', 500);
        }

        $user->roles()->attach($roles);

        return $user;

    }

    public function findById(int $id): ?User
    {
        $user = User::with(['roles:id,name'])->find($id);

        if (empty($user)) {
            throw new Exception('Role Not Found', 404);
        }

        return $user;
    }

    public function update(array $data, int $id): ?User
    {

        $user = $this->findById($id);

        $data['password'] = $this->makeHashPassword($data['password']);

        $roles = $data['role_id'];

        unset($data['role_id']);

        $update = $user->update($data);

        if (! $update) {
            throw new Exception('User Update Error', 404);
        }

        $user->roles()->sync($roles);

        return $user;
    }

    public function delete(int $id): ?User
    {

        $user = $this->findById($id);

        $delete = $user->delete();

        if (! $delete) {
            throw new Exception('User Deleting Error', 404);
        }

        return $user;
    }

    public function makeHashPassword(string $password): string
    {
        return Hash::make($password);
    }
}
