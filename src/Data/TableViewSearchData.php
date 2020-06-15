<?php

namespace LaravelViews\Data;

use LaravelViews\Data\Contracts\Searchable;
use Illuminate\Database\Eloquent\Builder;

class TableViewSearchData implements Searchable
{
    /**
     * Searchs an item by a query value, this search is executed when some filter or
     * the search value is changed
     *
     * @param Builder $query Current Eloquent query builder
     * @param Array|null $fields Array of fields to search for
     * @param String|null $value Value typed on the input search
     *
     * @return Builder Updated Eloquent query builder
     */
    public function searchItems(Builder $query, $fields, $value): Builder
    {
        if ($value) {
            foreach ($fields as $field) {
                if ($field === reset($fields)) {
                    $query->where($field, 'like', "%{$value}%");
                } else {
                    $query->orWhere($field, 'like', "%{$value}%");
                }
            }
        }

        return $query;
    }
}
