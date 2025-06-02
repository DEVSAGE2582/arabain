<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;



Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('home');

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login_user', [LoginController::class, 'login'])->name('login_user');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/Dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
       Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
    Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    Route::put('/{role}', [RoleController::class, 'update'])->name('update');


    });
});