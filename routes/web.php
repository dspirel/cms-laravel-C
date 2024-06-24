<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
<<<<<<< cms-users-func
use App\Http\Controllers\UserController;
=======
>>>>>>> dev

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', AuthController::class . '@showRegister')->name('register.show');
    Route::post('/register', AuthController::class . '@register')->name('register');

    Route::get('/login', AuthController::class . '@showLogin')->name('login.show');
    Route::post('/login', AuthController::class . '@login')->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', AuthController::class . '@showDashboard')->name('dashboard.show');
    Route::get('/logout', AuthController::class . '@logout')->name('logout');
});
<<<<<<< cms-users-func

Route::get('/users', UserController::class . '@index')->name('users.show');
=======
>>>>>>> dev
