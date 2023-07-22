<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission List as array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ],
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    //role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                ],
            ],

            [
                'group_name' => 'permission',
                'permissions' => [
                    // permision Permissions
                    'permission.create',
                    'permission.view',
                    'permission.edit',
                    'permission.delete',
                ],
            ],

        ];

        foreach ($permissions as $permission) {

            $group_name = $permission['group_name'];

            foreach ($permission['permissions'] as $per) {

                Permission::create(['name' => $per, 'group_name' => $group_name]);
            }

        }

        $role = Role::where('name', 'super admin')->first();
        $permission_ids = Permission::pluck('id');

        $role->permissions()->attach($permission_ids);
    }
}
