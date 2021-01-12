<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\RegisterService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegisterController extends Controller
{
    private $service;

    public function __construct(RegisterService $service)
    {
        $this->middleware('guest');
        $this->service = $service;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $this->service->register($request->toArray());
        } catch(\DomainException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('login')
            ->with('success', 'Registration completed successfully. Check your email for verification.');
    }

    public function verify($verifyToken)
    {
        try {
            $this->service->verify($verifyToken);
        } catch(ModelNotFoundException $e) {
            return redirect()->route('login')->with('error', "Given verify token is unidentified.");
        }

        return redirect()->route('login')
            ->with('success', 'Your email address has been verified. Now you can login.');
    }
}
