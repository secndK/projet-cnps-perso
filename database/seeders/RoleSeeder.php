<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $user = Role::create(['name' => 'User']);

        // Define permissions
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'view-user',
            'edit-user',
            'delete-user',
        ];
        // Create and assign permissions to roles
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);

            // Assign all permissions to Super Admin
            $superAdmin->givePermissionTo($permission);

            // Assign specific permissions to Admin
            if (in_array($permission->name, ['edit-role', 'view-user', 'edit-user'])) {
                $admin->givePermissionTo($permission);
            }
             // Assign specific permissions to User
             if (in_array($permission->name, [ 'view-user'])) {
                $user->givePermissionTo($permission);
            }
        }
    }
}
