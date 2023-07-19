<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'dashboard.view',
            'role.create',
            'role.view',
            'role.edit',
            'role.delete',
            'permission.create',
            'permission.view',
            'permission.edit',
            'permission.delete',
            'profile.view',
            'profile.edit',

        ];

        foreach($permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        $role = Role::where('name', 'super admin')->first();
        $permission_ids = Permission::pluck('id');

        $role->permissions()->attach($permission_ids);
    }
}
