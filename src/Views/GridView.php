<?php

namespace LaravelViews\Views;

class GridView extends TableView
{
    /** Component name */
    protected $view = 'grid-view.grid-view';

    public $cardComponent = 'laravel-views::components.card';

    /** Add a white background on each card */
    public $withBackground = false;

    /** Max cols to be render on xl */
    public $maxCols = 5;

    /**
     * Sets the default headers, which are needed on the TableView,
     * it is an empty array since those aren't needed for a grid view
     */
    protected function headers()
    {
        return [];
    }
}
