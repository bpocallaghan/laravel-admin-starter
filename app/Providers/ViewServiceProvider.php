<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Page;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers...
        View::composer('website.partials.side_news', function ($view) {
            $items = News::active()->orderBy('created_at', 'DESC')->get()->take(5);

            $view->with('news', $items);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
