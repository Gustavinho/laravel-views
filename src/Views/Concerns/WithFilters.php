<?php

namespace LaravelViews\Views\Concerns;

use Illuminate\Http\Request;

trait WithFilters
{
    /** @var Array Defined filters */
    public $filters = [];

    protected $defaultFilter = [];

    public function bootWithFilters(Request $request)
    {
        if (method_exists($this, 'filters')) {
            $this->filters = $this->filters();
        }

        foreach ($this->filters as $filter) {
            if (!isset($this->{$filter->id}))
                $this->{$filter->id} = $request->query($filter->id, $filter->defaultValue);

            $this->queryString[$filter->id] = ['except' => $filter->defaultValue];
        }
    }


    /**
     * Check if each of the filters has a default value and it's not already set
     * 
     * @return mixed
     */
    protected function applyFilters(&$data)
    {
        foreach ($this->filters as $filter) {
            if ($filter->shouldFilter($this->{$filter->id}))
                $data = $filter->apply(
                    $data,
                    $filter->parseValue($this->{$filter->id})
                ) ?? $data;
        }

        return $this;
    }

    public function updatedWithFilters()
    {
        if (method_exists($this, 'resetPage')) {
            $this->resetPage(); // reset pagingation
        }
    }

    public function clearFilters($filterId = null)
    {
        foreach ($this->filters as $filter) {
            if ($filterId != null && $filter->id != $filterId) continue;

            $this->{$filter->id} = $filter->defaultValue;
        }
    }
}
