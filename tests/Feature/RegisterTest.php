<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_register_page()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSeeText('Register');
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Kholif',
            'email' => 'kholif.faiz@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/home');
    }
}
