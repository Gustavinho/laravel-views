<?php

namespace LaravelViews\Filters;

use Carbon\Carbon;

class DateFilter extends BaseFilter
{
    public $type = 'date';

    public $view = 'date-filter';

    public function passValuesFromRequestToFilter($value)
    {
        return new Carbon($value);
    }
}
