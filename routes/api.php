<?php

use App\Http\Controllers\URLController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/shorten', [URLController::class, 'store']);
    Route::get('/shorten/{short_url}', [URLController::class, 'show']);

});
