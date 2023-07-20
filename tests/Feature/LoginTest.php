<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_login_return_access_token_in_valid_credential(): void
    {   
        $user = User::factory()->create();

        $response = $this->post('/api/v1/login',[
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['access_token']]);
    }

    public function test_login_return_error_invalid_credential(): void
    {   
        $response = $this->postJson('/api/v1/login', [
            'email' => 'email@email.com',
            'password' => 'password',
        ]);

        $response->assertStatus(404);
        $response->assertJson(['message' => 'User Email not exists']);
    }
}
