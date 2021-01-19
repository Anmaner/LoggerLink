<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\EmailChangeRequest;
use App\Models\User\EmailChange;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailChangeController extends Controller
{
    private $service;

    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }

    public function form()
    {
        $emailChange = Auth::user()->emailChange;

        return view('account.change_email', compact('emailChange'));
    }

    public function requestOldMail(EmailChangeRequest $request)
    {
        try {
            $this->service->requestOldMail($request->get('email'));
        } catch (\DomainException $e) {
            return redirect()->route('account.mail.change')->with('error', $e->getMessage());
        }

        return redirect()->route('account.mail.change');
    }

    public function requestNewMail(Request $request)
    {
        try {
            $this->service->requestNewMail();
        } catch (\DomainException $e) {
            return redirect()->route('account.mail.change')->with('error', $e->getMessage());
        }

        return redirect()->route('account.mail.change');
    }

    public function confirmOldMail(string $token)
    {
        try {
            $this->service->confirmOldMail($token);
        } catch (\DomainException $e) {
            return redirect()->route('account.mail.change')->with('error', $e->getMessage());
        }

        return redirect()->route('account.mail.change');
    }

    public function confirmNewMail(string $token)
    {
        try {
            $this->service->confirmNewMail($token);
        } catch (\DomainException $e) {
            return redirect()->route('account.mail.change')->with('error', $e->getMessage());
        }

        return redirect()->route('account.mail.change')->with('success', 'Your email address has been successfully changed.');
    }

    public function reset()
    {
        $this->service->resetEmailChange();

        return redirect()->route('account.mail.change')->with('success', 'Email change is successfully canceled.');
    }
}
