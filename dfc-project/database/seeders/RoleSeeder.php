<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['admin','analis','supervisor'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // buat user admin awal
        $admin = User::firstOrCreate(
            ['email' => 'admin@dfc.local'],
            ['name' => 'Admin Utama', 'password' => Hash::make('password')]
        );
        $admin->assignRole('admin');
    }
}
