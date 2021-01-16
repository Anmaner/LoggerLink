<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\PasswordChangeRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    private $service;

    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        return view('account.index', compact('request', 'user'));
    }

    public function changePassword()
    {
        return view('account.change_password');
    }

    public function changePasswordStore(PasswordChangeRequest $request)
    {
        if (!Hash::check($request->get('password'), Auth::user()->password)) {
            return back()->with('error', 'Old password is incorrect.');
        }

        Auth::user()->changePassword($request->get('password_new'));

        return back()->with('success', 'Password is successfully updated.');
    }
}
