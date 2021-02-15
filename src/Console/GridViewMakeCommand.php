<?php

namespace LaravelViews\Console;

class GridViewMakeCommand extends BaseViewCommand
{
    protected $viewName = 'grid';

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
}
