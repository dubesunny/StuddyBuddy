<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('dashboard');
Route::group([
    'namespace' => 'Auth',
    'middleware' => 'guest',
],function(){
    Route::get('register',[AuthController::class,'register'])->name('register');
    Route::post('register-attempt',[AuthController::class,'registerAttempt'])->name('registerAttempt');
});
Route::prefix('admin')->group(function(){
    Route::resource('users',UserController::class);
});
