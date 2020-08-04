<?php

namespace LaravelViews\Data;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Data\Contracts\Searchable;

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
        $relationalFields = array_filter($fields, function ($item) {
            return str_contains($item, '.');
        });

        $regularFields = array_diff($fields, $relationalFields);

        if ($value) {

            $query->where(function ($query) use ($value, $regularFields, $relationalFields) {

                foreach ($regularFields as $field) {
                    $query->orWhere($field, 'like', "%{$value}%");
                }

                foreach ($relationalFields as $relationalValue) {
                    $keys = explode('.', $relationalValue);

                    $query->orWhereHas($keys[0], function ($query) use ($value, $keys) {
                        $query->where($keys[1], 'like', "%{$value}%");
                    });
                }

            });


        }

        return $query;
    }
}
