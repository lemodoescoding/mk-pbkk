<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolePermissionSeeder::class);
    }

    public function test_guest_is_redirected_to_login_from_admin_panel(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_staf_can_access_admin_dashboard(): void
    {
        $staf = User::factory()->create();
        $staf->assignRole('Staf');

        $this->actingAs($staf)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Total Mahasiswa');
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Total Tugas Aktif');
    }

    public function test_user_without_role_is_forbidden_from_admin_panel(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }

    public function test_staf_cannot_delete_mahasiswa(): void
    {
        $staf = User::factory()->create();
        $staf->assignRole('Staf');

        $mahasiswa = Mahasiswa::factory()->create();

        $this->actingAs($staf)
            ->delete(route('admin.mahasiswa.destroy', $mahasiswa))
            ->assertForbidden();

        $this->assertDatabaseHas('mahasiswas', ['id' => $mahasiswa->id]);
    }

    public function test_admin_can_delete_mahasiswa(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');

        $mahasiswa = Mahasiswa::factory()->create();

        $this->actingAs($admin)
            ->delete(route('admin.mahasiswa.destroy', $mahasiswa))
            ->assertRedirect();

        $this->assertDatabaseMissing('mahasiswas', ['id' => $mahasiswa->id]);
    }

    public function test_staf_does_not_see_delete_button_on_search_page(): void
    {
        $staf = User::factory()->create();
        $staf->assignRole('Staf');

        Mahasiswa::factory()->create();

        $this->actingAs($staf)
            ->get('/admin/pencarian-mahasiswa')
            ->assertOk()
            ->assertDontSee('Hapus');
    }

    public function test_admin_sees_delete_button_on_search_page(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');

        Mahasiswa::factory()->create();

        $this->actingAs($admin)
            ->get('/admin/pencarian-mahasiswa')
            ->assertOk()
            ->assertSee('Hapus');
    }
}
