<?php

namespace App\Providers;

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
        // mysql key to long https://laravel-news.com/laravel-5-4-key-too-long-error
        \Schema::defaultStringLength(220);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if($this->app->environment('local'))
        {
            //$this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Bpocallaghan\Generators\GeneratorsServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
