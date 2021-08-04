<?php

namespace LaravelViews\Views;

class GridView extends ItemView
{
    /** Component name */
    protected $view = 'grid-view.grid-view';

    /** Add a white background on each card */
    public $withBackground = false;

    /** Max cols to be render on xl */
    public $maxCols = 5;

    protected $itemComponent = 'laravel-views::grid-view.grid-view-item';

    protected $itemDefinition = 'card';

    protected function extraItemProps($item)
    {
        return [
            'withBackground' => $this->withBackground,
            'model' => $item,
            'actions' => $this->actions,
            'hasDefaultAction' => $this->hasDefaultAction,
            'selected' => in_array($item->getKey(), $this->selected)
        ];
    }
}
