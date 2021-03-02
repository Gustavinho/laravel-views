<?php

namespace LaravelViews\Console;

use Illuminate\Console\Command;

class BaseViewCommand extends Command
{
    protected $viewName = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('make:view', [
            'type' => $this->viewName,
            'name' => $this->argument('name')
        ]);
    }
}
