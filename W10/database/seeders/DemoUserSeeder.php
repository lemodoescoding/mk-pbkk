<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $stafRole = Role::firstOrCreate(['name' => 'Staf', 'guard_name' => 'web']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@demo.test'],
            [
                'name' => 'Administrator Demo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );
        $admin->syncRoles([$adminRole]);

        $staf = User::firstOrCreate(
            ['email' => 'staf@demo.test'],
            [
                'name' => 'Staf Akademik Demo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );
        $staf->syncRoles([$stafRole]);

        // Akun tanpa role untuk menguji penolakan akses panel admin.
        User::firstOrCreate(
            ['email' => 'mahasiswa@demo.test'],
            [
                'name' => 'Mahasiswa Demo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );
    }
}
