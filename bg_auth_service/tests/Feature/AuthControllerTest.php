<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    // Test for loginUser method
    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'testpassword'),
            'type' => 'Admin', // Set the user type to 'Admin'
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status', 'message', 'userId', 'token'
                 ]);
    }

    public function test_can_get_writers()
    {
        // Create an admin user and authenticate
        $admin = User::factory()->create(['type' => 'Admin']);
        Sanctum::actingAs($admin);

        $response = $this->getJson('/api/writers');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status', 'users'
                 ]);
    }

    // Test for authCheck method
    public function test_auth_check()
    {
        // Create an admin user and authenticate
        $user = User::factory()->create(['type' => 'Admin']);
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/auth/check');

        $response->assertStatus(200)
                 ->assertJson(['status' => true]);
    }

    // Test for logout method
    public function test_user_can_logout(){
        $user = User::factory()->create([
            'type' => 'Admin', // Set the user type to 'Admin'
        ]);
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/auth/logout');

        $response->assertStatus(200)
                 ->assertJson(['status' => true, 'message' => 'logged out']);
    }
}