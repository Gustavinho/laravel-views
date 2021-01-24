<?php

namespace LaravelViews\Views;

class ListView extends DataView
{
    /** Component name */
    protected $view = 'list-view.list-view';

    public $itemComponent = 'laravel-views::list-view.list-item';
}
