<?php

namespace LaravelViews\Test\Mock;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class ActiveUsersFilter extends Filter
{
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

class MockTableViewWithSearchAndFilters extends MockTableView
{
    public $searchBy = ['email'];

    protected function filters()
    {
        return [
            new ActiveUsersFilter
        ];
    }
}
