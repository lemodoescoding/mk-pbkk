<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database without deleting existing records.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            DemoUserSeeder::class,
            AkademikSeeder::class,
        ]);
    }
}
