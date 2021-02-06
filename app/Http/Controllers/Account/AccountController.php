<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DefaultRender;
use App\Http\Requests\Account\PasswordChangeRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    use DefaultRender;

    private $request;
    private $service;

    public function __construct(Request $request, AccountService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function index()
    {
        return view('account.index', [
            'loggers' => $this->renderLoggers($this->request),
            'user' => $this->request->user()
        ]);
    }

    public function changePassword()
    {
        return view('account.change_password', [
            'loggers' => $this->renderLoggers($this->request)
        ]);
    }

    public function changePasswordStore(PasswordChangeRequest $request)
    {
        if (!Hash::check($request->get('password'), $request->user()->password)) {
            return back()->with('error', 'Old password is incorrect.');
        }

        $request->user()->changePassword($request->get('password_new'));

        return back()->with('success', 'Password is successfully updated.');
    }
}
