<?php

namespace LaravelViews\Console;

use Illuminate\Console\GeneratorCommand;

class MakeViewCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:view';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view
                            {type : The type of the new view: table, grid, list, detail }
                            {name : Name of the view, example: UsersTableView, Admin/UsersTableView }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Laravel Views component';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $view = $this->argument('type');

        return __DIR__ . "/../../stubs/{$view}-view.stub";
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
