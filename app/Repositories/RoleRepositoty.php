<?php

namespace App\Repositories;

use App\Interfaces\CrudInterfaces;
use App\Models\Role;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoleRepositoty implements CrudInterfaces
{
    public function getAll(array $filterData): LengthAwarePaginator
    {
        $perPage = $filterData['perPage'] ?? 10;

        return Role::orderBy('id', 'desc')->paginate($perPage);
    }

    public function create(array $data): ?Role
    {
        return Role::create($data);
    }

    public function findById(int $id): ?Role
    {
        $role = Role::find($id);

        if (empty($role)) {
            throw new Exception('Role Not Found', 404);
        }

        return $role;
    }

    public function update(array $data, int $id): ?Role
    {

        $role = $this->findById($id);

        $update = $role->update($data);

        if (! $update) {
            throw new Exception('Role Update Error', 404);
        }

        return $role;
    }

    public function delete(int $id): ?Role
    {
        $role = $this->findById($id);

        $delete = $role->delete();

        if (! $delete) {
            throw new Exception('Role Deleting Error', 404);
        }

        return $role;
    }
}
