<?php

namespace LaravelViews\Filters;

class BooleanFilter extends BaseFilter
{
    public $type = 'boolean';

    public $view = 'boolean-filter';

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
}
