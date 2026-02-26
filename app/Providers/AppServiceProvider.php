<?php

namespace App\Providers;

use App\Enum\CommonStatus;
use App\Models\Menu;
use App\Mixin\ResponseMixin;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\View;
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

        // Share header menus for frontend layout: keyed by slug + ordered list (so new menus appear)
        View::composer('frontend.layouts.app', function ($view) {
            $list = Menu::where('status', CommonStatus::Active)
                ->whereNotNull('slug')
                ->where('slug', '!=', '')
                ->orderBy('sort_order')
                ->orderBy('menu_name')
                ->get();
            $view->with([
                'headerMenus' => $list->keyBy('slug'),
                'headerMenusOrdered' => $list,
            ]);
        });
    }
}
