<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo 'Hello World';
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);


Route::post('loginSubmit', [AuthController::class, 'loginsubmit'])->name('loginsubmit');
