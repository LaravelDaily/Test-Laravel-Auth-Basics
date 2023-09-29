<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;

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

    public function test_email_can_be_verified()
    {
        $newData = [
            'name' => 'New name',
            'email' => 'new@email.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword'
        ];
        $response = $this->post('/register', $newData);
        $response->assertRedirect('/');

        $response = $this->get('/secretpage');
        $response->assertRedirect('/verify-email');

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

        $response = $this->get('/secretpage');
        $response->assertOk();
    }

    public function test_password_confirmation_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/verysecretpage');
        $response->assertRedirect('/confirm-password');

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_at_least_one_uppercase_lowercase_letter()
    {
        $user = [
            'name' => 'New name',
            'email' => 'new@email.com',
        ];

        $invalidPassword = '12345678';
        $validPassword = 'a12345678';

        $this->post('/register', $user + [
            'password' => $invalidPassword,
            'password_confirmation' => $invalidPassword
        ]);
        $this->assertDatabaseMissing('users', $user);

        $this->post('/register', $user + [
                'password' => $validPassword,
                'password_confirmation' => $validPassword
            ]);
        $this->assertDatabaseHas('users', $user);
    }
}
