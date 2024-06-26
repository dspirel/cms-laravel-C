<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesPermissionsController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', AuthController::class . '@showRegister')->name('register.show');
    Route::post('/register', AuthController::class . '@register')->name('register');

    Route::get('/login', AuthController::class . '@showLogin')->name('login.show');
    Route::post('/login', AuthController::class . '@login')->name('login');

});

Route::get('/test', RolesPermissionsController::class . '@test');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', AuthController::class . '@showDashboard')->name('dashboard.show');

    Route::get('/roles', RolesPermissionsController::class . '@showRoles')->name('roles.show');
    Route::get('/create-role', RolesPermissionsController::class . '@showRoleForm')->name('role.create.show');
    Route::post('/create-role', RolesPermissionsController::class . '@createRole')->name('role.create');

    Route::get('/users', UserController::class . '@index')->name('users.show');

    Route::get('/logout', AuthController::class . '@logout')->name('logout');
});


