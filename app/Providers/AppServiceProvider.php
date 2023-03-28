<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;

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
        //
//        Paginator::useBootstrap();

//        Model::unguard();

        Gate::define('admin', function (User $user) {
            return $user->username === 'hamidiqbal598';
        });

//        Blade::if('admin', function () {
//            return request()->user()?->can('admin');
//        });
        Blade::if('admin',function () {
            return request()->user()?->can('admin');
        });

    }
}
