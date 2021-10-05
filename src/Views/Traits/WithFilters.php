<?php

namespace LaravelViews\Views\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use LaravelViews\Data\QueryStringData;

trait WithFilters
{
    /** @var Array Defined filters */
    public $filters = [];

    /** @var Array Current active filters from the request query string */
    public $filter = [];

    public function mountWithFilters(QueryStringData $queryStringData)
    {
        $this->queryString[] = 'filter';

        $this->filter = $queryStringData->getFilterValues($this->filter);

        if (method_exists($this, 'filters')) {
            $this->filters = $this->filters();
        }
    }

    public function hydrateWithFilters()
    {
        $this->queryString[] = 'filter';

        if (method_exists($this, 'filters')) {
            $this->filters = $this->filters();
        }
    }

    /**
     * Check if each of the filters has a default value and it's not already set
     * 
     * @return mixed
     */
    protected function applyFilters(&$data)
    {
        $activeFilters = array_keys($this->filter);

        foreach ($this->filters as $filter) {
            if (in_array($filter->id, $activeFilters))
                $filter->apply($data, $this->filter[$filter->id], request());
        }

        return $this;
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

    public function clearFilters()
    {
        $this->filter = [];
    }
}
