<?php

namespace LaravelViews\Data;

use LaravelViews\Data\Contracts\Filterable;
use Illuminate\Database\Eloquent\Builder;

class TableViewFilterData implements Filterable
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
    public function applyFilters(Builder $query, $filters, $filterValues): Builder
    {
        if ($filterValues && is_array($filterValues) && count($filterValues) > 0) {
            foreach ($filters as $filter) {
                if (isset($filterValues[$filter->id])) {

                    /** Applies some transformation bwtween url query and filter class created */
                    $currentFilterValue = $filterValues[$filter->id];
                    $value = $filter->passValuesFromRequestToFilter($currentFilterValue);

                    if ($value !== "") {
                        $filter->apply($query, $value, request());
                    }
                }
            }
        }

        return $query;
    }
}
