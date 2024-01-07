<?php

use APP\Http\Controllers\LoginController;
use APP\Kernel\Router\Route;

return [
    Route::get('/check', [LoginController::class, 'checkToken']),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),
    Route::post('/reset', [LoginController::class, 'resetPassword']),
    Route::get('/test', function () {
        echo 'test';
    }),
];