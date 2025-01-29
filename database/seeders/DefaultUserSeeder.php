<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer les rôles s'ils n'existent pas
    $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
    $adminRole = Role::firstOrCreate(['name' => 'Admin']);
    $userRole = Role::firstOrCreate(['name' => 'User']);

    $superAdmin = User::create([
        'name' => 'Dark Koffi',
        'email' => 'koffikanje@gmail.com',
        'password' => Hash::make('password')
    ]);
    $superAdmin->assignRole('Super Admin');

    // Créer l'utilisateur Admin et lui assigner le rôle
    $admin = User::create([
        'name' => 'Gbané Hadja',
        'email' => 'jilmay02@gmail.com',
        'password' => Hash::make('password')
    ]);
    $admin->assignRole('Admin');

    // Créer l'utilisateur User et lui assigner le rôle
    $user = User::create([
        'name' => 'Gbanzéré',
        'email' => 'jilmay03@gmail.com',
        'password' => Hash::make('password')
    ]);
    $user->assignRole('User');
    }
}