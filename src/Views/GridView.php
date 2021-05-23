<?php

namespace LaravelViews\Views;

class GridView extends DataView
{
    /** Component name */
    protected $view = 'grid-view.grid-view';

    public $cardComponent = 'laravel-views::components.card';

    /** Add a white background on each card */
    public $withBackground = false;

    /** Max cols to be render on xl */
    public $maxCols = 5;

    public function getHasDefaultActionProperty()
    {
        return method_exists($this, 'onCardClick');
    }
}
