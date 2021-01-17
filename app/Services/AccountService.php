<?php

namespace App\Services;

use App\Mail\Account\EmailChanged;
use App\Mail\Account\NewMail;
use App\Mail\Account\OldMail;
use App\Models\User\EmailChange;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountService
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function requestOldMail(string $newEmail): void
    {
        $emailChange = EmailChange::create(Auth::user(), $newEmail);

        $this->mailer->to(Auth::user()->email)->send(new OldMail($emailChange->old_token));
    }

    public function requestNewMail(): void
    {
        $emailChange = Auth::user()->emailChange->requestNew();

        $this->mailer->to($emailChange->email)->send(new NewMail($emailChange->new_token));
    }

    public function confirmOldMail(string $token): void
    {
        if(!$emailChange = Auth::user()->emailChange) {
            throw new \DomainException('Invalid email token given.');
        }

        $emailChange->confirmOld($token);

        $this->mailer->to(Auth::user()->email)->send(new EmailChanged());
    }

    public function confirmNewMail(string $token): void
    {
        if(!$emailChange = Auth::user()->emailChange) {
            throw new \DomainException('Invalid email token given.');
        }

        $user = Auth::user();
        $newEmail = $emailChange->email;

        DB::transaction(function () use ($token, $user, $newEmail) {
            $user->emailChange->confirmNew($token);
            $user->changeEmail($newEmail);
        });

        $this->mailer->to($newEmail)->send(new EmailChanged());
    }
}
