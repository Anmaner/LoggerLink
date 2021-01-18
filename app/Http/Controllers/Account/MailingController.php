<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MailingController extends Controller
{
    public function index()
    {
        $notification = Auth::user()->notification
            ?? Notification::createDefault(Auth::user());

        return view('account.mailing', compact('notification'));
    }

    public function indexStore(Request $request)
    {
        Auth::user()->notification->update(
            $request->only(['offers', 'news', 'browser'])
        );

        return redirect()->route('account.mailing')
            ->with('success', 'Notification settings are successfully updated.');
    }
}
