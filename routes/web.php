<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BankController;
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
    Route::prefix('employee')->name('employee.')->controller(EmployeeController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::post('/{id}/toggle-status', 'toggleStatus')->name('toggleStatus');
    });

    Route::prefix('bank')->name('bank.')->controller(BankController::class)->group(function () {
        Route::get('/list', 'index')->name('list');
        Route::post('/store', 'store')->name('store');
        Route::post('/{id}/toggle-status', 'toggleStatus')->name('toggleStatus');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::post('/transfer', 'transfer')->name('transfer');


    });




    Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{role}/edit', 'edit')->name('edit');
        Route::put('/{role}', 'update')->name('update');
        Route::delete('/{role}', 'destroy')->name('destroy');
    });
});
