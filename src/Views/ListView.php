<?php

namespace LaravelViews\Views;

use LaravelViews\Views\Traits\WithSortableDropdown;

class ListView extends DataView
{
    use WithSortableDropdown;

    /** Component name */
    protected $view = 'list-view.list-view';

    public $itemComponent = 'laravel-views::list-view.list-item';
}
