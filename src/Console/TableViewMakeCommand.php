<?php

namespace Gustavinho\LaravelViews\Console;

use Illuminate\Console\GeneratorCommand;

class TableViewMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:table-view';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:table-view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new TableView class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . "/../../stubs/table-view.stub";
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
        return $rootNamespace . '\Views';
    }
}
