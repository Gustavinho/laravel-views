<?php

namespace LaravelViews\Views\Traits;

use LaravelViews\Data\QueryStringData;

trait WithSorting
{
    public $sortBy = null;

    public $sortOrder = 'asc';

    public function mountWithSorting(QueryStringData $queryStringData)
    {
        $this->queryString[] = 'sortBy';
        $this->queryString[] = 'sortOrder';

        $this->sortBy = $queryStringData->getValue('sortBy', $this->sortBy);
        $this->sortOrder = $queryStringData->getValue('sortOrder', $this->sortOrder);
    }

    public function hydrateWithSorting()
    {
        $this->queryString[] = 'sortBy';
        $this->queryString[] = 'sortOrder';
    }


    /**
     * Check if each of the filters has a default value and it's not already set
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applySorting($query)
    {
        if ($this->sortBy) {
            $query->orderBy($this->sortBy, $this->sortOrder);
        }

        return $query;
    }

    /**
     * Sets the field the table view data will be sort by
     * @param string $field Field to sort by
     */
    public function sort($field)
    {
        if ($this->sortBy === $field) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortOrder = 'asc';
        }
    }
}
