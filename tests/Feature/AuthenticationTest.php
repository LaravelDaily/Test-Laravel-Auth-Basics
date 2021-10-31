<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
