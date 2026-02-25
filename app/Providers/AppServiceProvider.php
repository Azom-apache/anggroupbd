<?php

namespace App\Providers;

use App\Mixin\ResponseMixin;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

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
        ResponseFactory::mixin(new ResponseMixin());
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }
}
