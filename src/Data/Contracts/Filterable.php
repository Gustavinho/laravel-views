<?php

namespace LaravelViews\Data\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Filterable
{
    /**
     * Applies every filter customized in the child class
     * the search value is changed
     *
     * @param Builder $query Current Eloquent query builder
     * @param Array|null $filters Array of filters declared on the children classes
     * @param Array|null $filterValues Array with all the filter values selected on the UI
     *
     * @return Builder Updated Eloquent query builder
     */
    public function applyFilters(Builder $query, $filters, $filterValues): Builder;
}
