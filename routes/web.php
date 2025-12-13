<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

//auth routes - user not logged
Route::middleware([CheckIsNotLogged::class])->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
});

// authenticated-only routes
Route::middleware([CheckIsLogged::class])->group(function() {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/new', [MainController::class, 'newNote'])->name('new');
    Route::post('/save', [MainController::class, 'saveNote'])->name('save');

    //edit note
    Route::get('/edit/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('/edit', [MainController::class, 'editSubmit'])->name('editSubmit');

    //delete note
    Route::get('/delete/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/deleteConfirm/{id}', [MainController::class, 'deleteConfirm'])->name('deleteConfirm');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
