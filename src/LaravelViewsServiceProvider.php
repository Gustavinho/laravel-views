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
use LaravelViews\Console\MakeViewCommand;
use LaravelViews\Data\Contracts\Sortable;
use LaravelViews\Data\TableViewSortData;
use LaravelViews\Macros\LaravelViewsTestMacros;
use LaravelViews\Macros\StrMacros;
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
        $this->app->bind('ui', UI::class);
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
            ->loadComponents()
            ->configFiles()
            ->macros();
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
            __DIR__ . '/../resources/views/detail-view' => resource_path('views/vendor/laravel-views/detail-view'),
            __DIR__ . '/../resources/views/grid-view' => resource_path('views/vendor/laravel-views/grid-view'),
            __DIR__ . '/../resources/views/list-view' => resource_path('views/vendor/laravel-views/list-view'),
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
                ListViewMakeCommand::class,
                MakeViewCommand::class
            ]);
        }

        return $this;
    }

    private function bladeDirectives()
    {
        $laravelViews = new LaravelViews;

        Blade::directive('laravelViewsScripts', function ($options) use ($laravelViews) {
            return $laravelViews->js($options);
        });

        Blade::directive('laravelViewsStyles', function ($options) use ($laravelViews) {
            return $laravelViews->css($options);
        });

        return $this;
    }

    private function loadComponents()
    {
        $laravelViews = new LaravelViews;

        // Registers anonymous components
        foreach ($laravelViews->components() as $path => $component) {
            Blade::component('laravel-views::components.' . $path, 'lv-' . $component);
        }
        Blade::component('laravel-views::view.layout', 'lv-layout');

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

    private function macros()
    {
        $macros = [
            LaravelViewsTestMacros::class,
            StrMacros::class
        ];

        foreach ($macros as $macroClass) {
            $macro = new $macroClass;
            $macro->register();
        }

        return $this;
    }
}
