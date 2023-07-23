<?php

namespace App\Repositories;

use App\Interfaces\CrudInterfaces;
use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PermissionRepository implements CrudInterfaces
{
    public function getAll(array $filterData): LengthAwarePaginator
    {
        $perPage = $filterData['perPage'] ?? 10;

        return Permission::orderBy('id', 'desc')->paginate($perPage);
    }

    public function create(array $data): ?Permission
    {   
        $permission = Permission::create($data);

        $this->addPerMissionToSuper($permission);

        if(empty($permission))
        {
            throw new Exception('Permission creating Error', 500);
        }

        return $permission;
    }

    public function findById(int $id): ?Permission
    {
        $permission = Permission::find($id);

        if (empty($permission)) {
            throw new Exception('Permission Not Found', 404);
        }

        return $permission;
    }

    public function update(array $data, int $id): ?Permission
    {

        $permission = $this->findById($id);

        $update = $permission->update($data);

        if (! $update) {
            throw new Exception('Permission Update Error', 404);
        }

        return $permission;
    }

    public function delete(int $id): ?Permission
    {
        $permission = $this->findById($id);

        $delete = $permission->delete();

        if (! $delete) {
            throw new Exception('Permission Deleting Error', 404);
        }

        return $permission;
    }

    public function addPerMissionToSuper(Permission $permission): void
    {
        $role = Role::where('name', 'super admin')->first();

        if(! $role)
        {
            throw new Exception('Role not found', 404);
        }

        $role->permissions()->attach($permission);

    }
}
