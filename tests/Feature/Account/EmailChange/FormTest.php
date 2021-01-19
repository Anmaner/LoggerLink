<?php

namespace Tests\Feature\Account\EmailChange;

use App\Models\User;
use App\Models\User\EmailChange;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class FormTest extends TestCase
{
    public function testOldRequest()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this->get(route('account.mail.change'));

        $response
            ->assertStatus(200)
            ->assertDontSee('class="status-bar');
    }

    public function testOldConfirm()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->state([
            'status' => EmailChange::OLD_REQUESTED,
            'old_token' => ($token = Str::random(40))
        ])->for($user)->create();

        $response = $this->get(route('account.mail.change'));

        $response
            ->assertStatus(200)
            ->assertSee('Verification token is sent. Please check your current email-address.');
    }

    public function testNewRequest()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->state([
            'status' => EmailChange::OLD_CONFIRMED
        ])->for($user)->create();

        $response = $this->get(route('account.mail.change'));

        $response
            ->assertStatus(200)
            ->assertSee('Old email-address is confirmed. Now you can request email to new email-address.');
    }

    public function testNewConfirm()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->state([
            'status' => EmailChange::NEW_REQUESTED,
            'new_token' => ($token = Str::random(40))
        ])->for($user)->create();

        $response = $this->get(route('account.mail.change'));

        $response
            ->assertStatus(200)
            ->assertSee('Verification token is sent to your new email-address.');
    }
}
