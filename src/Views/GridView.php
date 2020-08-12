<?php

namespace LaravelViews\Views;

class GridView extends TableView
{
    /** Component name */
    protected $view = 'grid-view.grid-view';

    public $cardComponent = 'laravel-views::components.card';

    public $withBackground = false;

    protected function headers()
    {
        return [];
    }
}
