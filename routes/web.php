<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\EmailChangeController;
use App\Http\Controllers\Account\MailingController;

use App\Http\Controllers\Logger\GenerateController;
use App\Http\Controllers\Logger\InformationController;
use App\Http\Controllers\Logger\RedirectController;
use App\Http\Controllers\Logger\StatisticsController;
use App\Http\Controllers\Logger\ExportController;
use App\Http\Controllers\Logger\FollowController;


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
    Route::get('/', [GenerateController::class, 'logger'])->name('generate');

    Route::get('{logger}/information', [InformationController::class, 'logger'])->name('information');
    Route::post('{logger}/information', [InformationController::class, 'loggerStore']);

    Route::get('{logger}/statistics', [StatisticsController::class, 'logger'])->name('statistics');

    Route::get('{logger}/export', [ExportController::class, 'formLogger'])->name('export');
    Route::post('{logger}/export', [ExportController::class, 'exportDownload']);
});

Route::group(['prefix' => 'shortener', 'as' => 'shortener.', 'namespace' => 'Logger'], function() {
    Route::get('/', [GenerateController::class, 'shortener'])->name('generate');

    Route::get('{logger}/information', [InformationController::class, 'shortener'])->name('information');
    Route::post('{logger}/information', [InformationController::class, 'shortenerStore']);

    Route::get('{logger}/statistics', [StatisticsController::class, 'shortener'])->name('statistics');

    Route::get('{logger}/redirect', [RedirectController::class, 'shortener'])->name('redirect');
    Route::post('{logger}/redirect', [RedirectController::class, 'shortenerStore']);

    Route::get('{logger}/export', [ExportController::class, 'formShortener'])->name('export');;
    Route::post('{logger}/export', [ExportController::class, 'exportDownload']);
});

Route::get('l-{logger}', [FollowController::class, 'logger'])->name('logger.follow');
Route::get('s-{logger}', [FollowController::class, 'shortener'])->name('shortener.follow');
