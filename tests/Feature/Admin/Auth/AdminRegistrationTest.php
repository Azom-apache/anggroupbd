<?php

namespace Tests\Feature\Admin\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_not_be_rendered(): void
    {
        $response = $this->get('/admin/register');

        $response->assertNotFound();
    }

    public function test_new_admins_can_not_register(): void
    {
        $response = $this->post('/admin/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertNotFound();
    }
}
