<?php

namespace LaravelViews\Filters;

abstract class SelectFilter extends Filter
{
    /**
     * The blade component that will be rendered.
     *
     * @var string
     */
    public string $component = 'laravel-views::filters.select';

    abstract public function options(): array;

    abstract public function apply(&$data, $value);

    public function shouldFilter($value)
    {
        return in_array($value, $this->options());
    }
}
