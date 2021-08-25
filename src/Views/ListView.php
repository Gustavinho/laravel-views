<?php

namespace LaravelViews\Views;

use LaravelViews\Views\Traits\WithSortableDropdown;

class ListView extends ItemView
{
    use WithSortableDropdown;

    /** Component name */
    protected $view = 'laravel-views::list-view.list-view';

    public $itemComponent = 'laravel-views::list-view.list-item';

    protected $itemDefinition = 'listItem';

    protected function extraItemProps($item)
    {
        return [
            'model' => $item,
            'actions' => $this->actions,
            'hasDefaultAction' => $this->hasDefaultAction,
        ];
    }
}
