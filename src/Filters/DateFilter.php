<?php

namespace LaravelViews\Filters;

use Carbon\Carbon;

abstract class DateFilter extends Filter
{
    /**
     * The blade component that will be rendered.
     *
     * @var string
     */
    public string $component = 'laravel-views::filters.date';

    abstract public function apply(&$data, Carbon $value);

    public function shouldFilter($value)
    {
        return !empty($value);
    }

    public function parseValue($value)
    {
        return new Carbon($value);
    }
}
