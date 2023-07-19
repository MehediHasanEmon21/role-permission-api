<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $user = User::factory()->create([
            'name' => 'Super User',
            'email' => 'super@super.com',
        ]);
        $user->roles()->attach(Role::where('name', 'super admin')->value('id'));
    }
}
