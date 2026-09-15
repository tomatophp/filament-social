<?php

use Illuminate\Support\Facades\Route;
use TomatoPHP\FilamentSocial\Http\Controllers\AuthController;

Route::middleware(['web', 'throttle:10'])->group(function () {
    Route::get('/login/{provider}', [AuthController::class, 'provider'])->name('login.provider');
    Route::get('/login/{provider}/callback', [AuthController::class, 'callback'])->name('login.provider.callback');
});
