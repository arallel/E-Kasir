<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Resources\Json\JsonResource;


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
         Paginator::defaultView('vendor.pagination.default'); 
        Paginator::defaultSimpleView('vendor.pagination.default');
        JsonResource::withoutWrapping();
    }
}
