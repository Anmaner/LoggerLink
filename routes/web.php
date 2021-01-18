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
use App\Http\Controllers\Account\MailingController;


Auth::routes();
Route::get('account_verify/{verify_token}', [RegisterController::class, 'verify'])->name('verify');

Route::get('/', [IndexController::class, 'index']);

Route::group(['middleware' => 'auth', 'prefix' => 'account', 'namespace' => 'Account', 'as' => 'account.'], function (){
    Route::get('/', [AccountController::class, 'index'])->name('index');

    Route::get('password/change', [AccountController::class, 'changePassword'])->name('password.change');
    Route::post('password/change', [AccountController::class, 'changePasswordStore']);

    Route::group(['prefix' => 'mail/change', 'as' => 'mail.'], function() {
        Route::get('/', [EmailChangeController::class, 'form'])->name('change');

        Route::post('request-old', [EmailChangeController::class, 'requestOldMail'])->name('request.old');
        Route::post('request-new', [EmailChangeController::class, 'requestNewMail'])->name('request.new');

        Route::get('confirm-old/{old_token}', [EmailChangeController::class, 'confirmOldMail'])->name('confirm.old');
        Route::get('confirm-new/{new_token}', [EmailChangeController::class, 'confirmNewMail'])->name('confirm.new');
    });

    Route::get('mailing', [MailingController::class, 'index'])->name('mailing');
    Route::post('mailing', [MailingController::class, 'indexStore']);
});
