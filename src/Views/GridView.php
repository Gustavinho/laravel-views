<?php

namespace LaravelViews\Views;

use LaravelViews\Views\Traits\WithSortableDropdown;

class GridView extends DataView
{
    use WithSortableDropdown;

    /** Component name */
    protected $view = 'grid-view.grid-view';

    public $cardComponent = 'laravel-views::grid-view.grid-view-item';

    /** Add a white background on each card */
    public $withBackground = false;

    /** Max cols to be render on xl */
    public $maxCols = 5;

    public function getHasDefaultActionProperty()
    {
        return method_exists($this, 'onCardClick');
    }
}
