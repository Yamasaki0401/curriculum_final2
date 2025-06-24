<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;


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
    public function boot()
    {
        View::composer(['*'], function ($view) {
            $popularCategories = Category::withCount('posts')
                ->orderByDesc('posts_count')
                ->take(5)
                ->get();

            $view->with('popularCategories', $popularCategories);
        });
    }
}
