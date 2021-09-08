<?php

namespace LaravelViews\Filters;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;

abstract class DateFilter extends BaseFilter
{
    public $type = 'date';

    /**
     * The blade component that will be rendered.
     *
     * @var string
     */
    public string $component = 'laravel-views::filters.date';

    public function passValuesFromRequestToFilter($value)
    {
        return new Carbon($value);
    }
}
