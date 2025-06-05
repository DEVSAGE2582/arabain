<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImpersonateController;



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

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('/generate-username', [UserController::class, 'generateUsername'])->name('users.generate-username');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


    });
    Route::get('/impersonate/{user_id}', [ImpersonateController::class,'impersonate'])->name('impersonate');

    Route::get('/impersonate-voucher-company/{user_id}',  [ImpersonateController::class,'impersonate_voucher_company'])->name('impersonate_voucher_company');

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
       Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
    Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
    Route::put('/{role}', [RoleController::class, 'update'])->name('update');


    });
});