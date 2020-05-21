<?php

namespace Gustavinho\LaravelViews;

use Gustavinho\LaravelViews\Console\ActionMakeCommand;
use Gustavinho\LaravelViews\Console\FilterMakeCommand;
use Gustavinho\LaravelViews\Console\TableViewMakeCommand;
use Gustavinho\LaravelViews\Data\Contracts\Filterable;
use Gustavinho\LaravelViews\Data\Contracts\Searchable;
use Gustavinho\LaravelViews\Data\TableViewFilterData;
use Gustavinho\LaravelViews\Data\TableViewSearchData;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        $this->app->bind(Searchable::class, TableViewSearchData::class);
        $this->app->bind(Filterable::class, TableViewFilterData::class);
        $this->app->bind('laravel-views', function () {
            return new LaravelViews();
        });

        $this->loadViews()
            ->loadCommands()
            ->publish();
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/../public/app.js' => public_path('vendor/laravel-views.js'),
            __DIR__.'/../public/app.css' => public_path('vendor/laravel-views.css'),
        ], 'public');

        return $this;
    }

    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__.'/blade-views', 'laravel-views');

        return $this;
    }

    private function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FilterMakeCommand::class,
                ActionMakeCommand::class,
                TableViewMakeCommand::class
            ]);
        }

        return $this;
    }
}
