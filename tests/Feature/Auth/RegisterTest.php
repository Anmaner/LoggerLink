<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testForm()
    {
        $response = $this->get(route('register'));

        $response
            ->assertStatus(200)
            ->assertSee('Sign up');
    }

    public function testValidation()
    {
        $response = $this->post(route('register'), [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response
            ->assertStatus(302)
            ->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function testSuccessfulRegister()
    {
        $user = User::factory()->make();

        $response = $this->post(route('register'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'))
            ->assertSessionHas('success', 'Registration completed successfully. Check your email for verification.');


        $userNew = User::where('email', $user->email)->firstOrFail();
        $this->assertEquals($userNew->name, $user->name);
        $this->assertEquals($userNew->email, $user->email);
        $this->assertNotEquals($userNew->password, $user->password);
        $this->assertNull($userNew->email_verified_at);
        $this->assertEquals(40, strlen($userNew->verify_token));
    }

    public function testSuccessfulVerify()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
            'verify_token' => ($token = Str::random(40)),
        ]);

        $response = $this->get(route('verify', $token));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'))
            ->assertSessionHas('success', 'Your email address has been verified. Now you can login.');

        $userNew = User::where('email', $user->email)->firstOrFail();
        $this->assertNull($userNew->verify_token);
        $this->assertNotNull($userNew->email_verified_at);
    }

    public function testIncorrectVerify()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
            'verify_token' => ($token = Str::random(40)),
        ]);

        $response = $this->get(route('verify', Str::random(40)));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'))
            ->assertSessionHas('error', 'Given verify token is unidentified.');

        $userNew = User::where('email', $user->email)->firstOrFail();
        $this->assertNotNull($userNew->verify_token);
        $this->assertNull($userNew->email_verified_at);
    }
}
