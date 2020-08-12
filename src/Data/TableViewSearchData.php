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


        if ($value) {

            $relationalFields = array_filter($fields, static function ($item) {
                return str_contains($item, '.');
            });

            $regularFields = array_diff($fields, $relationalFields);

            $query->where(static function ($query) use ($value, $regularFields, $relationalFields) {

                foreach ($regularFields as $field) {
                    $query->orWhere($field, 'like', "%{$value}%");
                }

                foreach ($relationalFields as $relationalValue) {

                    [$relationship, $field] = explode('.', $relationalValue);

                    $query->orWhereHas($relationship, static function ($query) use ($value, $field) {
                        $query->where($field, 'like', "%{$value}%");
                    });
                }

            });


        }

        return $query;
    }
}
