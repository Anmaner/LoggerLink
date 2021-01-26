<?php

use App\Models\User;
use App\Models\User\EmailChange;
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
use App\Http\Controllers\Logger\LoggerController;
use App\Http\Controllers\Logger\ShortenerController;


Auth::routes();
Route::get('account_verify/{verify_token}', [RegisterController::class, 'verify'])->name('verify');

Route::get('/', [IndexController::class, 'index'])->name('main');
Route::get('about', [IndexController::class, 'about'])->name('about');
Route::get('rules', [IndexController::class, 'rules'])->name('rules');

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

        Route::get('reset', [EmailChangeController::class, 'reset'])->name('reset');
    });

    Route::get('mailing', [MailingController::class, 'index'])->name('mailing');
    Route::post('mailing', [MailingController::class, 'indexStore'])->name('mailing');
});

Route::group(['prefix' => 'logger', 'as' => 'logger.', 'namespace' => 'Logger'], function() {
    Route::get('/', [LoggerController::class, 'generate'])->name('generate');

    Route::get('{logger}/information', [LoggerController::class, 'information'])->name('information');
    Route::post('{logger}/information', [LoggerController::class, 'informationStore']);

    Route::get('{logger}/statistics', [LoggerController::class, 'statistics'])->name('statistics');

    Route::get('{logger}/export', [LoggerController::class, 'export'])->name('export');
    Route::post('{logger}/export', [LoggerController::class, 'exportDownload']);
});

Route::group(['prefix' => 'shortener', 'as' => 'shortener.', 'namespace' => 'Logger'], function() {
    Route::get('/', [ShortenerController::class, 'generate'])->name('generate');

    Route::get('{token}/information', [ShortenerController::class, 'information'])->name('information');
    Route::post('{token}/information', [ShortenerController::class, 'informationStore']);

    Route::get('{token}/statistics', [ShortenerController::class, 'statistics'])->name('statistics');

    Route::get('{token}/redirect', [ShortenerController::class, 'redirect'])->name('redirect');
    Route::post('{token}/redirect', [ShortenerController::class, 'redirectStore']);

    Route::get('{token}/export', [ShortenerController::class, 'export'])->name('export');;
    Route::post('{token}/export', [LoggerController::class, 'exportDownload']);
});

Route::get('l-{logger}', [LoggerController::class, 'follow'])->name('logger.follow');
Route::get('s-{logger}', [ShortenerController::class, 'follow'])->name('shortener.follow');
