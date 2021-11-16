<?php

use App\Http\Controllers\GoogleSocialiteController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);

Route::get('/login', function () {
    if (auth()->check()) {
        return redirect('/home');
    }
    return view('login');
})->name('login');

Route::get('/auth/logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::middleware('auth')->get('/home', [HomeController::class, 'index']);
