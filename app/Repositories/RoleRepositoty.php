<?php

namespace App\Repositories;

use App\Interfaces\CrudInterfaces;
use App\Models\Role;

class RoleRepositoty implements CrudInterfaces {

    public function create(array $data): ?Role
    {
        return Role::create($data);
    }

}