<?php

namespace Tests\Feature\Account\EmailChange;

use App\Models\User;
use App\Models\User\EmailChange;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class NewEmailRequestTest extends TestCase
{
    public function testForm()
    {
        $this->create();

        $response = $this->get(route('account.mail.change'));

        $response
            ->assertStatus(200)
            ->assertSee('Request verification for new email.');
    }

    public function testInconsistentMethodCall()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->state([
            'status' => EmailChange::OLD_REQUESTED,
        ])->for($user)->create();

        $response = $this->post(route('account.mail.request.new'));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.mail.change'))
            ->assertSessionHas('error', 'Email change could not be completed.');
    }

    public function testSuccess()
    {
        $this->create();

        $response = $this
            ->followingRedirects()
            ->post(route('account.mail.request.new'));

        $response
            ->assertStatus(200)
            ->assertSee('Verification token is sent to your new email-address.');
    }

    private function create()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->state([
            'status' => EmailChange::OLD_CONFIRMED,
        ])->for($user)->create();
    }
}
