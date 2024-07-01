<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::define('permission', function (User $user,Closure $next, string $permission) {
        //     $userPermissions = Role::findOrFail($user->id)->permissions()->get();
        //     $userPermissions->pluck('name');

        //     if (in_array($permission, $userPermissions)) return true;

        //     return false;
        // });

        Blade::if('role', function ($role_name) {
            $role = Role::where('id', auth()->user()?->role_id)->first();
            return $role_name === $role->name;
        });

        DB::listen(function ($query) {
            Log::info($query->sql, $query->bindings);
        });
    }
}
