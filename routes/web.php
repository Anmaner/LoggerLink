<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\EmailChangeController;


Auth::routes();
Route::get('account_verify/{verify_token}', [RegisterController::class, 'verify'])->name('verify');

Route::get('/', [IndexController::class, 'index']);

Route::group(['middleware' => 'auth', 'prefix' => 'account', 'namespace' => 'Account', 'as' => 'account.'], function (){
    Route::get('/', [AccountController::class, 'index'])->name('index');
});
