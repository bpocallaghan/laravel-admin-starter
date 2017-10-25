<?php

namespace App\Providers;

use App\Models\Document;
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
        // include the news for the website 'side news' panel
        View::composer('website.partials.side_news', function ($view) {
            $items = News::whereHas('photos')
                ->active()
                ->orderBy('created_at', 'DESC')
                ->get()
                ->take(5);

            $view->with('news', $items);
        });

        // include the documents for the summernote modal
        View::composer('admin.partials.summernote.document', function ($view) {
            $items = Document::with('documentable')
                ->orderBy('name')
                ->get()
                ->pluck('name', 'url')
                ->toArray();

            $view->with('documents', $items);
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
