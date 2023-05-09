<?php

namespace App\Providers;
use App\Models\Image;
use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // $user = Auth::user()->id;
        // Paginator::useBootstrap();
        // view()->composer('*',function($view) {
        //     $view->with('image', dd($user));
        // });
        Paginator::defaultView('market');
        Paginator::useBootstrap();
        // Schema::defaultStringLength(191);
    }
}
