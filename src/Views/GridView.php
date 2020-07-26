<?php

namespace LaravelViews\Views;

class GridView extends TableView
{
    /** Component name */
    protected $view = 'grid-view.grid-view';

    protected function headers()
    {
        return [];
    }
}
