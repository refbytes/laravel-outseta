<?php

use Illuminate\Support\Facades\Route;

Route::post('/webhooks/event', \RefBytes\Outseta\Http\Controllers\Webhooks\EventController::class)
    ->withoutMiddleware([
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ])
    ->name('webhooks.event');

Route::post('/signup/callback', \RefBytes\Outseta\Http\Controllers\Webhooks\SignupCallbackController::class)
    ->withoutMiddleware([
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ])
    ->name('signup.callback');
