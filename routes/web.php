<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'throttle:10'])->group(function (){
    Route::get('/login/{provider}', [\TomatoPHP\FilamentSocial\Http\Controllers\AuthController::class, 'provider'])->name('login.provider');
    Route::get('/login/{provider}/callback', [\TomatoPHP\FilamentSocial\Http\Controllers\AuthController::class, 'callback'])->name('login.provider.callback');
});
