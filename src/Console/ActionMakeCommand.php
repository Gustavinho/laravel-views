<?php

namespace LaravelViews\Console;

use Illuminate\Console\GeneratorCommand;

class ActionMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:action';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name} {--bulk}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new laravel-views Action class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $isBulk = $this->option('bulk');
        if ($isBulk) {
            return __DIR__ . "/../../stubs/bulk-action.stub";
        }

        return __DIR__ . "/../../stubs/action.stub";
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
        return $rootNamespace;
    }
}
