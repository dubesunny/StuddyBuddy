<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyController;
use Illuminate\Support\Facades\Route;


Route::group([
    'namespace' => 'Auth',
    'middleware' => 'guest',
], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register-attempt', [AuthController::class, 'registerAttempt'])->name('registerAttempt');
    Route::get('/login',[AuthController::class,'login'])->name('login');
});

Route::controller(VerifyController::class)->group(function () {
    Route::get('/email/verify', 'notice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/resend/', 'resend')->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/', function () {
        return view('index');
    })->name('dashboard');
    Route::prefix('admin')->group(function () {


        Route::resource('users', UserController::class);
    });

});

