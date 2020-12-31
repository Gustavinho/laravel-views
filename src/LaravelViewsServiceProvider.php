<?php

namespace LaravelViews;

use LaravelViews\Console\ActionMakeCommand;
use LaravelViews\Console\FilterMakeCommand;
use LaravelViews\Console\TableViewMakeCommand;
use LaravelViews\Data\Contracts\Filterable;
use LaravelViews\Data\Contracts\Searchable;
use LaravelViews\Data\TableViewFilterData;
use LaravelViews\Data\TableViewSearchData;
use LaravelViews\UI\UI;
use LaravelViews\UI\Variants;
use LaravelViews\UI\Header;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use LaravelViews\Console\GridViewMakeCommand;
use LaravelViews\Data\Contracts\Sortable;
use LaravelViews\Data\TableViewSortData;

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
        $this->app->bind(Sortable::class, TableViewSortData::class);
        $this->app->bind('laravel-views', function () {
            return new LaravelViews();
        });
        $this->app->bind('variants', function () {
            return new Variants;
        });
        $this->app->bind('ui', function () {
            return new UI;
        });
        $this->app->bind('header', function () {
            return new Header();
        });

        $this->loadViews()
            ->loadCommands()
            ->publish()
            ->bladeDirectives()
            ->configFiles();
    }

    private function publish()
    {
        $this->publishes([
            __DIR__ . '/../public/laravel-views.js' => public_path('vendor/laravel-views.js'),
            __DIR__ . '/../public/laravel-views.css' => public_path('vendor/laravel-views.css'),
            __DIR__ . '/../public/tailwind.css' => public_path('vendor/tailwind.css'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/config/laravel-views.php' => config_path('laravel-views.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../resources/views/components' => resource_path('views/vendor/laravel-views/components'),
            __DIR__ . '/../resources/views/table-view' => resource_path('views/vendor/laravel-views/table-view'),
        ], 'views');

        return $this;
    }

    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-views');

        $laravelViews = new LaravelViews;
        foreach ($laravelViews->components() as $path => $component) {
            Blade::component('laravel-views::components.' . $path, $component);
        }

        return $this;
    }

    private function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FilterMakeCommand::class,
                ActionMakeCommand::class,
                TableViewMakeCommand::class,
                GridViewMakeCommand::class
            ]);
        }

        return $this;
    }

    private function bladeDirectives()
    {
        $laravelViews = new LaravelViews;
        Blade::directive('laravelViewsStyles', function ($options) use ($laravelViews) {
            return $laravelViews->css($options);
        });

        Blade::directive('laravelViewsScripts', function ($options) use ($laravelViews) {
            return $laravelViews->js($options);
        });

        return $this;
    }

    private function configFiles()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/laravel-views.php', 'laravel-views');

        return $this;
    }
}
