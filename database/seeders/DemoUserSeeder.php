<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create permission
        $permission = Permission::firstOrCreate(['name' => 'demo']);

        // Create role
        $role = Role::firstOrCreate(['name' => 'demo']);

        // Assign permission to role
        $role->givePermissionTo($permission);

        // Create user
        $user = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo User',
                'password' => bcrypt('password123'),
            ]
        );

        // Assign role to user
        $user->assignRole($role);
    }
}
