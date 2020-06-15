<?php

namespace LaravelViews\Data\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface Searchable
{
    /**
     * Applies every filter customized in the child class
     * the search value is changed
     *
     * @param Builder $query Current Eloquent query builder
     * @param Array|null $fields Array of fields to search for
     * @param String|null $value Value typed on the input search
     *
     * @return Builder Updated Eloquent query builder
     */
    public function searchItems(Builder $query, $fields, $value): Builder;
}
