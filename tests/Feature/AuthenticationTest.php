<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_routes_are_protected_from_public()
    {
        $response = $this->get('/profile');
        $response->assertStatus(302);
        $response->assertRedirect('login');

        $response = $this->put('/profile');
        $response->assertStatus(302);
        $response->assertRedirect('login');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/profile');
        $response->assertOk();
    }

    public function test_profile_link_is_invisible_in_public()
    {
        $response = $this->get('/');
        $this->assertStringNotContainsString('href="/profile"', $response->getContent());

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $this->assertStringContainsString('href="/profile"', $response->getContent());
    }

    public function test_profile_fields_are_visible()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/profile');
        $this->assertStringContainsString('value="'.$user->name.'"', $response->getContent());
        $this->assertStringContainsString('value="'.$user->email.'"', $response->getContent());
    }

    public function test_profile_name_email_update_successful()
    {
        $user = User::factory()->create();
        $newData = [
            'name' => 'New name',
            'email' => 'new@email.com'
        ];
        $this->actingAs($user)->put('/profile', $newData);
        $this->assertDatabaseHas('users', $newData);

        // Check if the user is still able to log in - password unchanged
        $this->assertTrue(Auth::attempt([
            'email' => $user->email,
            'password' => 'password'
        ]));
    }

    public function test_profile_password_update_successful()
    {
        $user = User::factory()->create();
        $newData = [
            'name' => 'New name',
            'email' => 'new@email.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword'
        ];
        $this->actingAs($user)->put('/profile', $newData);

        // Check if the user is able to log in with the new password
        $this->assertTrue(Auth::attempt([
            'email' => $user->email,
            'password' => 'newpassword'
        ]));
    }
}
