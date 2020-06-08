<?php

namespace Gustavinho\LaravelViews\Test\Mock;

use Gustavinho\LaravelViews\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ActiveUsersFilter extends Filter
{
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->where('active', $value);
    }

    public function options(): Array
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
