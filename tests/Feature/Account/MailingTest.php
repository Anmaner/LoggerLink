<?php

namespace Tests\Feature\Account;

use App\Models\User;
use App\Models\User\Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MailingTest extends TestCase
{
    use DatabaseTransactions;

    public function testForm()
    {
        $this->actingAs(
            User::factory()->create()
        );

        $response = $this->get(route('account.mailing'));

        $response
            ->assertStatus(200)
            ->assertSee('Mailing settings');
    }

    public function testSuccess()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );

        Notification::factory()->for($user)->create();


        $response = $this->post(route('account.mailing', [
            'offers' => '1',
            'news' => '1',
            'browser' => '0'
        ]));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('account.mailing'))
            ->assertSessionHas('success', 'Notification settings are successfully updated.');
    }
}
