<?php

namespace Tests\Feature\Account;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PasswordChangeTest extends TestCase
{
    use DatabaseTransactions;

    public function testForm()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this->get(route('account.password.change'));

        $response
            ->assertStatus(200)
            ->assertSee('Change password');
    }

    public function testValidation()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this
            ->from(route('account.password.change'))
            ->post(route('account.password.change'), [
                'password' => '',
                'password_new' => '',
                'password_new_confirmation' => ''
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.password.change'))
            ->assertSessionHasErrors(['password', 'password_new']);
    }

    public function testWrongPassword()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this
            ->from(route('account.password.change'))
            ->post(route('account.password.change'), [
                'password' => 'wrongPassword',
                'password_new' => '123123123',
                'password_new_confirmation' => '123123123'
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.password.change'))
            ->assertSessionHas(['error' => 'Old password is incorrect.']);
    }

    public function testPasswordsDiffer()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this
            ->from(route('account.password.change'))
            ->post(route('account.password.change'), [
                'password' => 'password',
                'password_new' => '123123123',
                'password_new_confirmation' => '111111111'
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.password.change'))
            ->assertSessionHasErrors(['password_new' => 'The password new confirmation does not match.']);
    }

    public function testSuccess()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this
            ->from(route('account.password.change'))
            ->post(route('account.password.change'), [
                'password' => 'password',
                'password_new' => '123123123',
                'password_new_confirmation' => '123123123'
            ]);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.password.change'))
            ->assertSessionHas(['success' => 'Password is successfully updated.']);
    }
}
