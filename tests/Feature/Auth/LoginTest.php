<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testForm()
    {
        $response = $this->get(route('login'));

        $response
            ->assertStatus(200)
            ->assertSee('Sign in');
    }

    public function testValidation()
    {
        $response = $this->post(route('login'), [
            'email' => '',
            'password' => ''
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(['email', 'password']);
    }


    public function testSuccessfulLogin()
    {
        $user = User::factory(['email_verified_at' => Carbon::now()])->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/');

        $this->assertAuthenticated();
    }

    public function testNotVerifiedLogin()
    {
        $user = User::factory(['email_verified_at' => null])->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'))
            ->assertSessionHas('error', 'Your account is not verified. Please check your email account.');

        $this->assertGuest();
    }
}
