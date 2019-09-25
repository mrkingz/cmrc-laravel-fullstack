<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('partials._alert', 'alert');

        Blade::component('partials._content', 'content');

        Blade::component('partials._new-order', 'neworder');

        Blade::component('partials._modal', 'modal');

        Blade::component('partials._response', 'response');

        Paginator::defaultView('pagination::simple-bootstrap-4');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
