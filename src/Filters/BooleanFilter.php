<?php

namespace Gustavinho\LaravelViews\Filters;

class BooleanFilter extends BaseFilter
{
    public $type = 'boolean';

    public $view = 'boolean-filter';

    public function passValuesFromRequestToFilter($values)
    {
        $options = collect($this->options())->values()->toArray();
        $valuesToFilter = [];

        foreach ($options as $option) {
            if (isset($values[$option])) {
                $valuesToFilter[$option] = true;
            } else {
                $valuesToFilter[$option] = false;
            }
        }

        return $valuesToFilter;
    }
}
