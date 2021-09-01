<?php

namespace LaravelViews\Filters;

use Illuminate\Contracts\View\View;

abstract class BooleanFilter extends BaseFilter
{
    public $type = 'boolean';

    public $view = 'laravel-views::filters.boolean';

    public function passValuesFromRequestToFilter($values)
    {
        $options = collect($this->options())->values()->toArray();
        $valuesToFilter = [];

        foreach ($options as $option) {
            if (isset($values[$option]) && filter_var($values[$option], FILTER_VALIDATE_BOOLEAN)) {
                $valuesToFilter[$option] = true;
            } else {
                $valuesToFilter[$option] = false;
            }
        }

        return $valuesToFilter;
    }

    public function isChecked($option)
    {
        $values = $this->value();

        return isset($values[$option]) && $values[$option];
    }

    public function render(): View
    {
        return view('laravel-views::filters.boolean');
    }
}
