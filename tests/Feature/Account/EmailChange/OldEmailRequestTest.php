<?php

namespace Tests\Feature\Account\EmailChange;

use App\Models\User;
use App\Models\User\EmailChange;
use Faker\Provider\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

class OldEmailRequestTest extends TestCase
{
    use DatabaseTransactions;

    public function testValidationEmpty()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this
            ->from(route('account.mail.change'))
            ->post(route('account.mail.request.old'), ['email' => '']);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.mail.change'))
            ->assertSessionHasErrors(['email' => 'The email field is required.']);
    }

    public function testEmailAlreadyExistsInEmailChanges()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->state([
            'email' => 'test@example.com'
        ])->for($user)->create();


        $response = $this
            ->from(route('account.mail.change'))
            ->post(route('account.mail.request.old'), ['email' => 'test@example.com']);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.mail.change'))
            ->assertSessionHasErrors(['email' => 'The email has already been taken.']);
    }

    public function testEmailAlreadyExistsInUsers()
    {
        $this->actingAs(
            $user = User::factory()->create(['email' => 'test@example.com'])
        );

        EmailChange::factory()->for($user)->create();

        $response = $this
            ->from(route('account.mail.change'))
            ->post(route('account.mail.request.old'), ['email' => 'test@example.com']);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.mail.change'))
            ->assertSessionHasErrors(['email' => 'The email has already been taken.']);
    }

    public function testEmailChangeAlreadyCreated()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->for($user)->create();

        $response = $this
            ->post(route('account.mail.request.old'), ['email' => 'test@example.com']);

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.mail.change'))
            ->assertSessionHas('error', 'Email change is already in process.');
    }

    public function testSuccess()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this
            ->followingRedirects()
            ->post(route('account.mail.request.old'), ['email' => 'test@example.com']);

        $response
            ->assertStatus(200)
            ->assertSee('Verification token is sent. Please check your current email-address.');
    }
}
