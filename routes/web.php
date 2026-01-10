<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('dashboard');

Route::prefix('admin')->group(function(){
    Route::resource('users',UserController::class);
});
