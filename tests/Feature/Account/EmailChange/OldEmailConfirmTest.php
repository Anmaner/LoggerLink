<?php

namespace Tests\Feature\Account\EmailChange;

use App\Models\User;
use App\Models\User\EmailChange;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class OldEmailConfirmTest extends TestCase
{
    public function testWrongToken()
    {
        $this->create();

        $response = $this->get(route('account.mail.confirm.old', Str::random(40)));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.mail.change'))
            ->assertSessionHas('error', 'Invalid email token given.');
    }

    public function testInconsistentMethodCall()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->state([
            'status' => EmailChange::NEW_REQUESTED,
            'old_token' => ($token = Str::random(40))
        ])->for($user)->create();

        $response = $this->get(route('account.mail.confirm.old', $token));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.mail.change'))
            ->assertSessionHas('error', 'Email change could not be completed.');
    }

    public function testSuccess()
    {
        $token = $this->create();

        $response = $this
            ->followingRedirects()
            ->get(route('account.mail.confirm.old', $token));

        $response
            ->assertStatus(200)
            ->assertSee('Old email-address is confirmed. Now you can request email to new email-address.');
    }

    private function create()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->state([
            'status' => EmailChange::OLD_REQUESTED,
            'old_token' => ($token = Str::random(40))
        ])->for($user)->create();

        return $token;
    }
}
