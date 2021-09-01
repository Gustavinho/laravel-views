<?php

namespace LaravelViews\Views\Traits;

use LaravelViews\Data\QueryStringData;

trait WithFilters
{
    /** @var Array Current query string with the filters value */
    public $filter = [];

    public function mountWithFilters(QueryStringData $queryStringData)
    {
        $this->queryString[] = 'filter';

        $this->filter = $queryStringData->getFilterValues($this->filter);
    }

    public function hydrateWithFilters()
    {
        $this->queryString[] = 'filter';
    }

    /**
     * Check if each of the filters has a default value and it's not already set
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyFilters($query)
    {
        $activeFilters = array_keys($this->filter);

        foreach ($this->filters as $filter) {
            if (in_array($filter->id, $activeFilters))
                $filter->apply($query, $this->filter[$filter->id], request());
        }

        return $query;
    }

    public function updatedFilter($value, $key)
    {
        if ($value == '' || $value == null) unset($this->filter[$key]);
        $this->resetPage();
    }

    protected function filters()
    {
        return [];
    }

    public function getFiltersProperty()
    {
        return $this->filters();
    }

    public function clearFilters()
    {
        $this->filter = [];
    }
}
