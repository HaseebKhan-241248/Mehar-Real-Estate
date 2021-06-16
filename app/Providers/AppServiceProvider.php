<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rules\has;
use Blade;
use Illuminate\Support\Facades\Blade as FacadesBlade;

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
        FacadesBlade::if('can', function ($module,$operation)
        {
            return has::permission($module,$operation);
        });
    }
}
