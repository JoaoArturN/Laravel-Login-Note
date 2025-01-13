<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('main');
    Route::get('/newNote', [MainController::class, 'newNotes'])->name('createNotes');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // notes

    Route::get('/edit/{id}', [MainController::class, 'edit'])->name('edit');
    Route::post('/editSubmit', [MainController::class, 'editSubmit'])->name('editSubmit');

    Route::get('/delete/{id}', [MainController::class, 'delete'])->name('delete');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteConfirm'])->name('deleteConfirm');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');
});

Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('loginSubmit', [AuthController::class, 'loginsubmit'])->name('loginsubmit');
});
