<?php

namespace Tests\Feature\Account\EmailChange;

use App\Models\User;
use App\Models\User\EmailChange;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmailChangeTest extends TestCase
{
    public function testForm()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this->get(route('account.mail.change'));

        $response
            ->assertStatus(200)
            ->assertSee('Change email');
    }

    public function testFormWithNoAuth()
    {
        $response = $this->get(route('account.mail.change'));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testReset()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        EmailChange::factory()->for($user)->create();

        $response = $this->get(route('account.mail.reset'));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.mail.change'))
            ->assertSessionHas('success', 'Email change is successfully canceled.');
    }
}
