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
        $roles = ['Super Admin', 'Admin', 'User']; // correspond aux noms que tu as créés
        $nbRoles = count($roles);

        User::factory()->count(30)->create()->each(function ($user, $index) use ($roles, $nbRoles) {
            $roleIndex = intdiv($index, 3) % $nbRoles;
            $user->assignRole($roles[$roleIndex]);

        });




    }
}
