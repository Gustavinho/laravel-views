<?php

namespace LaravelViews\Views\Traits;

use LaravelViews\Data\QueryStringData;

trait WithSorting
{
    public $sortBy = null;

    public $sortOrder = null;

    /** @var Array Defined sortable columns */
    public $sortableBy;

    public function mountWithSorting(QueryStringData $queryStringData)
    {
        $this->queryString[] = 'sortBy';
        $this->queryString[] = 'sortOrder';

        $this->sortBy = $queryStringData->getValue('sortBy', $this->sortBy);
        $this->sortOrder = $queryStringData->getValue('sortOrder', $this->sortOrder);

        if (method_exists($this, 'sortableBy')) {
            $this->sortableBy = collect($this->sortableBy());
        }
    }

    public function hydrateWithSorting()
    {
        $this->queryString[] = 'sortBy';
        $this->queryString[] = 'sortOrder';

        if (method_exists($this, 'sortableBy')) {
            $this->sortableBy = collect($this->sortableBy());
        }
    }

    /**
     * Check if each of the filters has a default value and it's not already set
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applySorting($query)
    {
        if ($this->sortBy) {
            $this->sortOrder = $this->sortOrder ?? 'asc';

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
            switch ($this->sortOrder) {
                case 'asc':
                    $sortOrder = 'desc';
                    break;
                case 'desc':
                    $sortOrder = null;
                    $this->sortBy = null;
                    break;
                default:
                    $sortOrder = 'asc';
                    break;
            }
            $this->sortOrder = $sortOrder;
        } else {
            $this->sortBy = $field;
            $this->sortOrder = 'asc';
        }
    }
}
