<?php

namespace LaravelViews\Filters;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;

abstract class DateFilter extends BaseFilter
{
    public $type = 'date';

    public $view = 'date';

    public function passValuesFromRequestToFilter($value)
    {
        return new Carbon($value);
    }

    public function render(): View
    {
        return view('laravel-views::filters.date');
    }
}
