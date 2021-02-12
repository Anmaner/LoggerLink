<?php

namespace App\Services\Account;

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
        if($this->getUser()->emailChange()->first()) {
            throw new \DomainException('Email change is already in process.');
        }

        $emailChange = EmailChange::create($this->getUser(), $newEmail);

        $this->mailer->to($this->getUser()->email)->send(new OldMail($emailChange->old_token));
    }

    public function requestNewMail(): void
    {
        $emailChange = $this->getUser()->emailChange->requestNew();

        $this->mailer->to($emailChange->email)->send(new NewMail($emailChange->new_token));
    }

    public function confirmOldMail(string $token): void
    {
        if(!$emailChange = $this->getUser()->emailChange) {
            throw new \DomainException('Invalid email token given.');
        }

        $emailChange->confirmOld($token);

        $this->mailer->to($this->getUser()->email)->send(new EmailChanged());
    }

    public function confirmNewMail(string $token): void
    {
        if(!$emailChange = $this->getUser()->emailChange) {
            throw new \DomainException('Invalid email token given.');
        }

        $user = $this->getUser();
        $newEmail = $emailChange->email;

        DB::transaction(function () use ($token, $user, $newEmail) {
            $user->emailChange->confirmNew($token);
            $user->changeEmail($newEmail);
        });

        $this->mailer->to($newEmail)->send(new EmailChanged());
    }

    public function resetEmailChange(): void
    {
        $this->getUser()->emailChange->delete();
    }

    protected function getUser()
    {
        return Auth::user();
    }
}
