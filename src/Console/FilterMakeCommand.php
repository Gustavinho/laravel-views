<?php

namespace LaravelViews\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class FilterMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:filter';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filter {name} {--type=select}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new laravel-views Filter class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Filter';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $type = $this->option('type');
        $stub = 'filter';

        if ($type == 'boolean') {
            $stub = 'boolean-filter';
        }

        if ($type == 'date') {
            $stub = 'date-filter';
        }

        return __DIR__ . "/../../stubs/{$stub}.stub";
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
