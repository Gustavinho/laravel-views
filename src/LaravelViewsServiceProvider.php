<?php

namespace Gustavinho\LaravelViews;

use Gustavinho\LaravelViews\Console\FilterMakeCommand;
use Illuminate\Support\ServiceProvider;

class LaravelViewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $file =  __DIR__ . '/helpers.php';
        if (file_exists($file)) {
            require_once($file);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/blade-views', 'laravel-views');

        $this->publishes([
            __DIR__.'/../public/app.js' => public_path('vendor/admin/app.js'),
        ], 'public');

        if ($this->app->runningInConsole()) {
            $this->commands([
                FilterMakeCommand::class
            ]);
        }
    }
}
