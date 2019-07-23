<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;

class GlobalDataProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'admin/*',
            'App\Composers\AdminComposer'
        ); 

        view()->composer(
            'auth/*',
            'App\Composers\AuthComposer'
        );    
    }
}
