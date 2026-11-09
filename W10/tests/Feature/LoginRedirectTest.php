<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DemoUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginRedirectTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            RolePermissionSeeder::class,
            DemoUserSeeder::class,
        ]);
    }

    public function test_admin_login_is_redirected_to_admin_panel(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@demo.test',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated();
    }

    public function test_staf_login_is_redirected_to_admin_panel(): void
    {
        $response = $this->post('/login', [
            'email' => 'staf@demo.test',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated();
    }

    public function test_user_without_admin_role_is_redirected_to_public_home(): void
    {
        $response = $this->post('/login', [
            'email' => 'mahasiswa@demo.test',
            'password' => 'password',
        ]);

        $response->assertRedirect('/beranda');
        $this->assertAuthenticated();
    }

    public function test_demo_login_button_authenticates_the_selected_account(): void
    {
        $response = $this->post('/demo-login/staf');

        $response->assertRedirect('/admin');

        $this->assertAuthenticatedAs(User::query()->where('email', 'staf@demo.test')->firstOrFail());
    }
}
