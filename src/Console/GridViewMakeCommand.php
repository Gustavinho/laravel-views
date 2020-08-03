<?php

namespace LaravelViews\Console;

use Illuminate\Console\GeneratorCommand;

class GridViewMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:grid-view';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:grid-view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new GridView class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . "/../../stubs/grid-view.stub";
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Livewire';
    }
}
