<?php

namespace LaravelViews\Filters;

abstract class CheckboxFilter extends Filter
{
    public $defaultValue = [];

    /**
     * The blade component that will be rendered.
     *
     * @var string
     */
    public string $component = 'laravel-views::filters.checkbox';

    public function shouldFilter($value)
    {
        return !empty($value);
    }
}
