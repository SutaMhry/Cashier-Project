<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('login');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');
});