<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function testRegister()
    {
        $user = User::register(
            $name = 'name',
            $email = 'email',
            $password = 'password',
        );

        $this->assertEquals($name, $user->name);
        $this->assertEquals($email, $user->email);
        $this->assertNotEquals($password, $user->password);

        $this->assertFalse($user->isVerified());

        $this->assertEquals(40, strlen($user->verify_token));
        $this->assertNull($user->email_verified_at);
    }

    public function testSuccessfulVerify()
    {
        $user = User::register(
            $name = 'name',
            $email = 'email',
            $password = 'password',
        );

        $user->verify($time = Carbon::now());

        $this->assertTrue($user->isVerified());
        $this->assertNull($user->verify_token);
        $this->assertEquals($time->toDateTimeString(), $user->email_verified_at);
    }

    public function testAlreadyVerified()
    {
        $user = User::register(
            $name = 'name',
            $email = 'email',
            $password = 'password',
        );

        $user->verify($time = Carbon::now());

        $this->expectExceptionMessage('User is already verified.');

        $user->verify($time = Carbon::now());
    }
}
