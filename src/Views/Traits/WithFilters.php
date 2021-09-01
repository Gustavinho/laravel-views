<?php

namespace LaravelViews\Views\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
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

    public function updatedWithFilters($name, $value)
    {
        $name = Str::of($name);
        $key = $name->after('.');
        $name = $name->before('.');

        if ($name == 'filter') {
            if ($value == '' || $value == null)
                Arr::forget($this->filter, $key);

            if (method_exists($this, 'resetPage')) {
                $this->resetPage(); // reset pagingation
            }
        }
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
