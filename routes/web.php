<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', AuthController::class . '@showRegister')->name('register.show');
    Route::post('/register', AuthController::class . '@register')->name('register');

    Route::get('/login', AuthController::class . '@showLogin')->name('login.show');
    Route::post('/login', AuthController::class . '@login')->name('login');
});

//Route::get('/test', RoleController::class . '@test');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', DashboardController::class . '@showDashboard')->name('dashboard.show');

    Route::prefix('dashboard')->group(function () {
        //Users
        Route::name('dashboard.')->group(function () {
            Route::resource('users', UserController::class);
        });

        //Roles
        Route::group(['prefix' => 'roles','as' => 'dashboard.','middleware' => 'can:all, App\Models\Role'], function () {
            //index
            Route::get('/', RoleController::class . '@index')->name('roles.index');
            //new
            Route::get('/create', RoleController::class . '@create')->name('roles.create');
            Route::post('/create', RoleController::class . '@store')->name('roles.store');
            //edit
            Route::get('/{role}/edit', RoleController::class . '@edit')->name('roles.edit');
            Route::patch('/{role}/edit', RoleController::class . '@update')->name('roles.update');
            //delete
            Route::delete('/{role}', RoleController::class . '@destroy')->name('roles.destroy');
        });
    });

    Route::get('/logout', AuthController::class . '@logout')->name('logout');
});


