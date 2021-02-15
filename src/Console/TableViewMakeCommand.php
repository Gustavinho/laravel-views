<?php

namespace LaravelViews\Console;

class TableViewMakeCommand extends BaseViewCommand
{
    protected $viewName = 'table';

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
}
