<?php

namespace LaravelViews\Filters;

use Illuminate\Contracts\View\View;

abstract class Filter extends BaseFilter
{
    public $type = 'select';

    /**
     * The blade component that will be rendered.
     *
     * @var string
     */
    public string $component = 'laravel-views::filters.select';
}
