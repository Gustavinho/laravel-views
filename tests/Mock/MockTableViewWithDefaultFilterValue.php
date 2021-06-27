<?php

namespace LaravelViews\Test\Mock;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class DefaultFilterValue extends Filter
{
    public $defaultValue = 1;

    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->where('active', $value);
    }

    public function options(): array
    {
        return [
            'Active' => 1,
            'Disabled' => 0,
        ];
    }
}

class MockTableViewWithDefaultFilterValue extends MockTableView
{
    protected function filters()
    {
        return [
            new DefaultFilterValue
        ];
    }
}
