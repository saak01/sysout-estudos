<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        $paginationView = 'vendor.pagination.bootstrap-4';

        Paginator::defaultView($paginationView);

        Paginator::defaultSimpleView($paginationView);
    }
}
