<?php

use Illuminate\Support\Facades\Route;

Route::middleware('web')
    ->group(function () {
        Route::view(config('outseta.support.form.url'), 'outseta::support.form')
            ->middleware(config('outseta.support.form.middleware'))
            ->name('support');
    });
