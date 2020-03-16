<?php

namespace Gustavinho\LaravelViews\Views;

use Illuminate\Http\Request;

class TableFiltersView extends View
{

    protected $view = 'filters';

    public $fieldsToSearch = null;
    public $search;
    private $filters = null;

    protected $updatesQueryString = ['search'];

    public function mount($searchBy)
    {
        $this->fieldsToSearch = $searchBy;
        $this->search = request()->query('search', $this->search);
    }

    protected function getData(Request $request)
    {
        // Only get filters with value
        $filterValues = collect($request->query('filters', []))->filter(function ($value) {
            if ($value != "" && $value != null) {
                return true;
            }

            return false;
        });

        return [
            'searchValue' => $request->query('query', ''),
            'filtersValues' => $filterValues->toArray(),
            'filters' => $this->filters
        ];
    }

    public function setFieldsToSearch($fields)
    {
        $this->fieldsToSearch = $fields;

        return $this;
    }

    public function setFilters($filters)
    {
        if ($filters && count($filters)) {
            foreach ($filters as $filter) {
                $this->filters[$filter->id] = $filter;
            }
        }

        return $this;
    }
}
