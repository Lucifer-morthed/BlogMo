<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        // Share categories and recent posts globally across all views
        View::composer('*', function ($view) {
            $categories = Category::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->take(8)
                ->get();

            $recentPosts = Post::with(['user', 'categories'])
                ->published()
                ->latest('published_at')
                ->take(5)
                ->get();

            $view->with('globalCategories', $categories);
            $view->with('globalRecentPosts', $recentPosts);
        });
    }
}
