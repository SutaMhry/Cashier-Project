<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/login', 'authenticate')->name('authenticate');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dash', function () {
        return view('dashboard');
    })->name('admin-dash');

    Route::resource('categories', CategoryController::class);

    Route::resource('menus', MenuController::class);

    Route::resource('users', UserController::class);

});

Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/pos', [MenuController::class, 'pos'])->name('pos');
});