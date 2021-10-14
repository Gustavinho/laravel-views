<?php

namespace LaravelViews\Filters;

abstract class SwitchFilter extends Filter
{
    public $defaultValue = false;

    /**
     * The blade component that will be rendered.
     *
     * @var string
     */
    public string $component = 'laravel-views::filters.switch';

    abstract public function apply(&$data);

    public function shouldFilter($value)
    {
        return $value == true;
    }
}
