<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')
    ->group(function () {
        Route::view('register', 'outseta::auth.register')
            ->middleware(['guest'])
            ->name('register');
        Route::view('login', 'outseta::auth.login')
            ->name('login');
        Route::view('profile', 'outseta::auth.profile')
            ->middleware(['auth'])
            ->name('profile.edit');

        Route::get('/auth/callback', \RefBytes\Outseta\Http\Controllers\Auth\LoginController::class)
            ->name('auth.callback');
    });
