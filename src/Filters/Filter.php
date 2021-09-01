<?php

namespace LaravelViews\Filters;

use Illuminate\Contracts\View\View;

abstract class Filter extends BaseFilter
{
    public $type = 'select';

    public $view = 'select';

    public function render(): View
    {
        return view('laravel-views::filters.select');
    }
}
