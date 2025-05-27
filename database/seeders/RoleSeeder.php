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
            'view-role',
            'edit-role',
            'delete-role',

            'create-user',
            'view-user',
            'edit-user',
            'delete-user',

            'create-poste',
            'view-poste',
            'edit-poste',
            'delete-poste',


            'create-type-poste',
            'view-type-poste',
            'edit-type-poste',
            'delete-type-poste',

            'create-peripherique',
            'view-peripherique',
            'edit-peripherique',
            'delete-peripherique',


            'create-type-peripherique',
            'view-type-peripherique',
            'edit-type-peripherique',
            'delete-type-peripherique',

            'create-attribution',
            'view-attribution',
            'edit-attribution',
            'delete-attribution',


        ];
        // Create and assign permissions to roles
        foreach ($permissions as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);

            // Assign all permissions to Super Admin
            $superAdmin->givePermissionTo($permission);

            // Assign specific permissions to Admin
            if (in_array($permission->name, [


                'create-role',
                'view-role',



                'create-user',
                'view-user',



                'create-poste',
                'view-poste',


                'create-type-poste',
                'view-type-poste',



                'create-peripherique',
                'view-peripherique',


                'create-type-peripherique',
                'view-type-peripherique',



                'create-attribution',
                'view-attribution',





                ])) {
                $admin->givePermissionTo($permission);
            }
             // Assign specific permissions to User
             if (in_array($permission->name, [

                'view-poste',

                'view-type-poste',

                'view-peripherique',

                'view-type-peripherique',

                'view-attribution',

                ])) {
                $user->givePermissionTo($permission);
            }
        }
    }
}
