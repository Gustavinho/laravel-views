<?php

namespace Gustavinho\LaravelViews\Test\Mock;

use Gustavinho\LaravelViews\Filters\Filter;

class ActiveUsersFilter extends Filter
{
    public function apply($query, $value)
    {
        return $query->where('active', $value);
    }

    public function options()
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
