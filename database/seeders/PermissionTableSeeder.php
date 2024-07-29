<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissions array
        $permissions = [
            'permission list',
            'permission create',
            'permission edit',
            'permission delete',
            'role list',
            'role create',
            'role edit',
            'role delete',
            'user list',
            'user create',
            'user edit',
            'user delete',
            'post list',
            'post create',
            'post edit',
            'post delete',
        ];
      
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Roles
        $roles =[
            'Admin',
            'User',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Admin User
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
        $adminUser->assignRole('Admin');

        // Assign all permissions to Admin
        $adminRole = Role::findByName('Admin');
        $adminRole->syncPermissions($permissions);

        // Normal User
        $normalUser = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
            'email_verified_at' => now(),
        ]);
        $normalUser->assignRole('User');

        // User Role with limited permissions
        $userRole = Role::findByName('User');
        $userPermissions = ['user list', 'user create', 'user edit', 'user delete', 'post list', 'post create', 'post edit', 'post delete'];
        $userRole->syncPermissions($userPermissions);

        // Test User
        $testUser = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => Hash::make('test123'),
            'email_verified_at' => now(),
        ]);

        // Assign only user related permissions to Test User
        $testUserPermissions = ['user list', 'user create', 'user edit', 'user delete'];
        $testUser->givePermissionTo($testUserPermissions);
    }
}
