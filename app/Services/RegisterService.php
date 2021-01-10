<?php

namespace App\Services;

use App\Mail\Auth\VerifyMail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Carbon;

class RegisterService
{
    private $mailer;
    private $dispatcher;

    public function __construct(Mailer $mailer, Dispatcher $dispatcher)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }

    public function register(array $data): User
    {
        $user = User::register(
            $data['name'],
            $data['email'],
            $data['password']
        );

        $this->mailer->to($user->email)->send(new VerifyMail($user));
        $this->dispatcher->dispatch(new Registered($user));

        return $user;
    }

    public function verify($verifyToken): void
    {
        $user = User::where('verify_token', $verifyToken)->firstOrFail();

        $user->verify(Carbon::now());
    }
}
