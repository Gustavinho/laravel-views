<?php

namespace LaravelViews\Console;

use Illuminate\Console\GeneratorCommand;

class ListViewMakeCommand extends BaseViewCommand
{
    protected $viewName = 'list';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:list-view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new ListView class';
}
