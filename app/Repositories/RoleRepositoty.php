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

        return Role::with(['permissions:id,name,group_name'])->orderBy('id', 'desc')->paginate($perPage);
    }

    public function create(array $data): ?Role
    {

        $permissions = $data['permissions'] ?? false;

        unset($data['permissions']);

        $role = Role::create($data);

        if ($permissions) {
            $role->permissions()->attach($permissions);
        }

        return $role;
    }

    public function findById(int $id): ?Role
    {
        $role = Role::with(['permissions:id,name,group_name'])->find($id);

        if (empty($role)) {
            throw new Exception('Role Not Found', 404);
        }

        return $role;
    }

    public function update(array $data, int $id): ?Role
    {

        $role = $this->findById($id);

        $permissions = $data['permissions'] ?? false;

        unset($data['permissions']);

        $update = $role->update($data);

        if ($permissions) {
            $role->permissions()->sync($permissions);
        }

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
