<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create demo permission if not exists
        $permission = Permission::firstOrCreate(['name' => 'demo']);

        // Create demo role if not exists and assign permission
        $role = Role::firstOrCreate(['name' => 'demo']);
        $role->givePermissionTo($permission);

        // Create a demo user
        $user = User::firstOrCreate(
            ['email' => 'demo@example.com'],  // Check if user already exists by email
            [
                'name' => 'Demo User',
                'password' => bcrypt('password123'),
            ]
        );

        // Assign demo role to user
        $user->assignRole($role);

        // Optionally create other test users
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
