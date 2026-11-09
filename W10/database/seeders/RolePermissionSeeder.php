<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * @var array<int, string>
     */
    public const PERMISSIONS = [
        'view-dashboard',
        'manage-mahasiswa',
        'manage-dosen',
        'manage-tugas',
        'hapus-data',
    ];

    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (self::PERMISSIONS as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $staf = Role::firstOrCreate(['name' => 'Staf', 'guard_name' => 'web']);

        $admin->syncPermissions(self::PERMISSIONS);

        $staf->syncPermissions([
            'view-dashboard',
            'manage-mahasiswa',
            'manage-dosen',
            'manage-tugas',
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
