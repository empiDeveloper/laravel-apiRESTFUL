<?php
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->namespace('auth')->group( function() {
    $controller = "AuthController";

    Route::post('/', "$controller@login")->name('auth.login');
});
