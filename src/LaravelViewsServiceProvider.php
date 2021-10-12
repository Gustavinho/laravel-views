<?php

namespace LaravelViews;

use Artificertech\LaravelRenderable\Renderable;
use LaravelViews\Console\ActionMakeCommand;
use LaravelViews\Console\FilterMakeCommand;
use LaravelViews\Console\TableViewMakeCommand;
use LaravelViews\Data\Contracts\Filterable;
use LaravelViews\Data\Contracts\Searchable;
use LaravelViews\Data\TableViewFilterData;
use LaravelViews\Data\TableViewSearchData;
use LaravelViews\UI\Variants;
use LaravelViews\UI\SortableHeader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use LaravelViews\Console\GridViewMakeCommand;
use LaravelViews\Console\ListViewMakeCommand;
use LaravelViews\Console\MakeViewCommand;
use LaravelViews\Data\Contracts\Sortable;
use LaravelViews\Data\TableViewSortData;

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
            return new Renderable;
        });

        $this->app->bind('sortable-header', function () {
            return new SortableHeader();
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
            ->configureComponents()
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

    /**
     * Configure the Blade components.
     *
     * @return $this
     */
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('badge');
            $this->registerComponent('button');
            $this->registerComponent('buttons.icon-and-text');
            $this->registerComponent('buttons.icon');
            $this->registerComponent('buttons.select');
            $this->registerComponent('dropdown.index', 'dropdown');
            $this->registerComponent('dropdown.header');
            $this->registerComponent('form.checkbox');
            $this->registerComponent('form.datepicker');
            $this->registerComponent('form.input-group');
            $this->registerComponent('form.input');
            $this->registerComponent('form.select');
            $this->registerComponent('icon');
            $this->registerComponent('img');
            $this->registerComponent('link');
            $this->registerComponent('modal');
        });

        return $this;
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component, $alias = null)
    {
        $alias = $alias ?? $component;

        Blade::component('laravel-views::components.' . $component, 'lv-' . $alias);
    }

    private function configFiles()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/laravel-views.php', 'laravel-views');

        return $this;
    }

    private function macros()
    {
        Str::macro('classNameAsSentence', function ($className) {
            $intermediate = preg_replace('/(?!^)([[:upper:]][[:lower:]]+)/', ' $0', $className);
            $titleStr = preg_replace('/(?!^)([[:lower:]])([[:upper:]])/', '$1 $2', $intermediate);

            return $titleStr;
        });

        Str::macro('camelToDash', function ($str) {
            return strtolower(preg_replace('%([a-z])([A-Z])%', '\1-\2', $str));
        });

        $file =  __DIR__ . '/renderableMacros.php';
        if (file_exists($file)) {
            require_once($file);
        }

        return $this;
    }
}
