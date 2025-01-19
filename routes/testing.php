<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'outseta'])
    ->group(function () {
        Route::get('/testing/dashboard', function () {
            return 'Dashboard';
        })
            ->name('testing.dashboard');
    });
