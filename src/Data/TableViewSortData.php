<?php

namespace LaravelViews\Data;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Data\Contracts\Sortable;

class TableViewSortData implements Sortable
{
    /**
     * Add a sort sentence to the query
     *
     * @param Builder $query Current Eloquent query builder
     * @param String $field Field the query will be sort by
     * @param Bool $sortnat Compare items as strings using "natural ordering" like natsort()
     * @param String $order Could be asc or desc
     *
     * @return Builder Updated Eloquent query builder
     */
    public function sortItems(Builder $query, $field, $sortnat, $order = 'asc'): Builder
    {
        if ($field) {
            if ($sortnat == true) {
                $query->orderByRaw('LENGTH(' . $field . ') ' . $order . ', ' . $field . ' ' . $order);
            } else {
                $query->orderBy($field, $order);
            }
        }

        return $query;
    }
}
