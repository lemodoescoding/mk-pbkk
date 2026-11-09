<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchFilterTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);

        $this->admin = User::factory()->create();
        $this->admin->assignRole('Admin');
    }

    public function test_search_matches_name_or_nrp(): void
    {
        $andi = Mahasiswa::factory()->create([
            'nama' => 'Andi Wijaya',
            'nrp' => '5025000001',
            'departemen' => 'Teknik Informatika',
            'is_active' => true,
        ]);
        $budi = Mahasiswa::factory()->create([
            'nama' => 'Budi Santoso',
            'nrp' => '5025000002',
            'departemen' => 'Sistem Informasi',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin)
            ->get('/admin/pencarian-mahasiswa?search=Andi')
            ->assertOk()
            ->assertSee($andi->nama)
            ->assertDontSee($budi->nama);

        $this->actingAs($this->admin)
            ->get('/admin/pencarian-mahasiswa?search=5025000002')
            ->assertOk()
            ->assertSee($budi->nama)
            ->assertDontSee($andi->nama);
    }

    public function test_filter_by_departemen_and_status(): void
    {
        $aktif = Mahasiswa::factory()->create([
            'nama' => 'Mahasiswa Aktif TI',
            'departemen' => 'Teknik Informatika',
            'is_active' => true,
        ]);
        $nonaktif = Mahasiswa::factory()->create([
            'nama' => 'Mahasiswa Cuti SI',
            'departemen' => 'Sistem Informasi',
            'is_active' => false,
        ]);

        $this->actingAs($this->admin)
            ->get('/admin/pencarian-mahasiswa?departemen=Teknik+Informatika&status=aktif')
            ->assertOk()
            ->assertSee($aktif->nama)
            ->assertDontSee($nonaktif->nama);
    }

    public function test_pagination_keeps_filter_query_string(): void
    {
        Mahasiswa::factory()->count(15)->create([
            'nama' => 'Andi Filter',
            'departemen' => 'Teknik Informatika',
            'is_active' => true,
        ]);

        $this->actingAs($this->admin)
            ->get('/admin/pencarian-mahasiswa?search=Andi&status=aktif')
            ->assertOk()
            ->assertSee('search=Andi')
            ->assertSee('status=aktif')
            ->assertSee('page=2');
    }
}
