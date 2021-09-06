<?php

namespace LaravelViews\Views;

class GridView extends DataView
{
    /** Add a white background on each card */
    public $withBackground = false;

    /** Max cols to be render on xl */
    public $maxCols = 5;

    public function render()
    {
        return view('laravel-views::grid-view.grid-view');
    }
}
