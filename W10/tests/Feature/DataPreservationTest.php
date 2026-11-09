<?php

namespace Tests\Feature;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use App\Models\User;
use Database\Seeders\AkademikSeeder;
use Database\Seeders\DemoUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DataPreservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeders_do_not_delete_existing_users(): void
    {
        $existing = User::factory()->create([
            'email' => 'existing@example.com',
            'name' => 'Existing User',
        ]);

        $this->seed([
            RolePermissionSeeder::class,
            DemoUserSeeder::class,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $existing->id,
            'email' => 'existing@example.com',
            'name' => 'Existing User',
        ]);
    }

    public function test_academic_seeder_does_not_duplicate_existing_records(): void
    {
        Mahasiswa::factory()->create();
        $dosen = Dosen::factory()->create();
        Tugas::factory()->create(['dosen_id' => $dosen->id]);

        $this->seed(AkademikSeeder::class);

        $this->assertSame(1, Mahasiswa::query()->count());
        $this->assertSame(1, Dosen::query()->count());
        $this->assertSame(1, Tugas::query()->count());
    }
}
