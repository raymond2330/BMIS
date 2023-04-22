<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    public function test_login_admin()
    {
        $response = $this->post('/login', [
            'email' => 'secretary@server.com',
            'password' => 'secretary'
        ]);
        $response->assertRedirect('/dashboard');
    }
    public function test_login_failed()
    {
        $response = $this->post('/login', [
            'email' => 'secretary@server.com',
            'password' => 'wrong-password'
        ]);
        $this->assertGuest();
    }
}
