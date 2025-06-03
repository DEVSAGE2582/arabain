<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;

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

    Route::prefix('employee')->name('employee.')->controller(EmployeeController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');



    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{role}/edit', 'edit')->name('edit');
        Route::put('/{role}', 'update')->name('update');
        Route::delete('/{role}', 'destroy')->name('destroy');
    });
});
