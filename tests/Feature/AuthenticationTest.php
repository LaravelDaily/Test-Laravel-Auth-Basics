<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_routes_are_protected_from_public(): void
    {
        $response = $this->get(route('profile.show'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));

        $response = $this->put(route('profile.update'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('profile.show'));
        $response->assertOk();
    }

    public function test_profile_link_is_invisible_in_public(): void
    {
        $response = $this->get(route('home'));
        $this->assertStringNotContainsString('href="/profile"', $response->getContent());

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('home'));
        $this->assertStringContainsString('href="/profile"', $response->getContent());
    }

    public function test_profile_fields_are_visible(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('profile.show'));
        $this->assertStringContainsString('value="' . $user->name . '"', $response->getContent());
        $this->assertStringContainsString('value="' . $user->email . '"', $response->getContent());
    }

    public function test_profile_name_email_update_successful(): void
    {
        $user = User::factory()->create();
        $newData = [
            'name' => 'New name',
            'email' => 'new@email.com'
        ];
        $this->actingAs($user)->put(route('profile.update'), $newData);
        $this->assertDatabaseHas('users', $newData);

        // Check if the user is still able to log in - password unchanged
        $this->assertTrue(Auth::attempt([
            'email' => $user->email,
            'password' => 'password'
        ]));
    }

    public function test_profile_password_update_successful(): void
    {
        $user = User::factory()->create();
        $newData = [
            'name' => 'New name',
            'email' => 'new@email.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword'
        ];
        $this->actingAs($user)->put(route('profile.update'), $newData);

        // Check if the user is able to log in with the new password
        $this->assertTrue(Auth::attempt([
            'email' => $user->email,
            'password' => 'newpassword'
        ]));
    }

    public function test_email_can_be_verified(): void
    {
        $newData = [
            'name' => 'New name',
            'email' => 'new@email.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword'
        ];
        $response = $this->post(route('register'), $newData);
        $response->assertRedirect('/');

        $response = $this->get(route('secretpage'));
        $response->assertRedirect(route('verification.notice'));

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $this->actingAs($user)->get($verificationUrl);
        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());

        $response = $this->get(route('secretpage'));
        $response->assertOk();
    }

    public function test_password_confirmation_page(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('verysecretpage'));
        $response->assertRedirect(route('password.confirm'));

        $response = $this->actingAs($user)->post(route('password.confirm.store'), [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_at_least_one_uppercase_lowercase_letter(): void
    {
        $user = [
            'name' => 'New name',
            'email' => 'new@email.com',
        ];

        $invalidPassword = '12345678';
        $validPassword = 'a12345678';

        $this->post(route('register'), $user + [
                'password' => $invalidPassword,
                'password_confirmation' => $invalidPassword
            ]);
        $this->assertDatabaseMissing('users', $user);

        $this->post(route('register'), $user + [
                'password' => $validPassword,
                'password_confirmation' => $validPassword
            ]);
        $this->assertDatabaseHas('users', $user);
    }
}
