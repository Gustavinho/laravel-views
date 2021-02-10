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
use LaravelViews\Console\ListViewMakeCommand;
use LaravelViews\Data\Contracts\Sortable;
use LaravelViews\Data\TableViewSortData;
use LaravelViews\Views\Components\DynamicComponent;

class LaravelViewsServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        Searchable::class => TableViewSearchData::class,
        Filterable::class => TableViewFilterData::class,
        Sortable::class => TableViewSortData::class,
    ];

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
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
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

        return $this;
    }

    private function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FilterMakeCommand::class,
                ActionMakeCommand::class,
                TableViewMakeCommand::class,
                GridViewMakeCommand::class,
                ListViewMakeCommand::class
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

        // Registers anonymous components
        foreach ($laravelViews->components() as $path => $component) {
            Blade::component('laravel-views::components.' . $path, 'lv-' . $component);
        }

        // Registering class components
        Blade::component('lv-dynamic-component', DynamicComponent::class);

        // This is only for laravel 8
        // Blade::componentNamespace('LaravelViews\\Views\\Components', 'lv');

        return $this;
    }

    private function configFiles()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/laravel-views.php', 'laravel-views');

        return $this;
    }
}
