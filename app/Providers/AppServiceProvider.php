<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
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

        if (!app()->runningInConsole()) {
            Paginator::useBootstrap();
            $settings = Setting::check_setting();
            $categories = Category::with('child')->where('parent', 0)->orWhere('parent', null)->get();
            $lastFivePosts = Post::with('category', 'user')->orderBy('id')->limit(5)->get();
            View()->share([
                'settings' => $settings,
                'categories' => $categories,
                'lastFivePosts' => $lastFivePosts,
            ]);
        }
    }
}
