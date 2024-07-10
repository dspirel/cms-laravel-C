<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NavigationController;
use App\Models\Navigation;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', AuthController::class . '@showRegister')->name('register.show');
    Route::post('/register', AuthController::class . '@register')->name('register');

    Route::get('/login', AuthController::class . '@showLogin')->name('login.show');
    Route::post('/login', AuthController::class . '@login')->name('login');
});

//Custom page index
Route::get('/nav/{name}', NavigationController::class . '@customIndex')->name('customIndex');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', DashboardController::class . '@showDashboard')->name('dashboard.show');

    Route::prefix('dashboard')->group(function () {
        Route::name('dashboard.')->group(function () {
            //Users
            Route::resource('users', UserController::class);
            //Pages
            Route::resource('pages', PageController::class);
            //Navigation
            Route::resource('navigation', NavigationController::class);
        });

        //Roles
        Route::group(['prefix' => 'roles','as' => 'dashboard.roles.'], function () {
            //index
            Route::get('/', RoleController::class . '@index')->name('index');
            //new
            Route::get('/create', RoleController::class . '@create')->name('create');
            Route::post('/create', RoleController::class . '@store')->name('store');
            //edit
            Route::get('/{role}/edit', RoleController::class . '@edit')->name('edit');
            Route::patch('/{role}/edit', RoleController::class . '@update')->name('update');
            //delete
            Route::delete('/{role}', RoleController::class . '@destroy')->name('destroy');
        });
    });

    Route::get('/logout', AuthController::class . '@logout')->name('logout');
});


