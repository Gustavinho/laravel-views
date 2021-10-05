<?php

namespace LaravelViews\Filters;

abstract class BooleanFilter extends BaseFilter
{
    public $type = 'boolean';

    /**
     * The blade component that will be rendered.
     *
     * @var string
     */
    public string $component = 'laravel-views::filters.boolean';

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
