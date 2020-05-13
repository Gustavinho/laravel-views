<?php

namespace Gustavinho\LaravelViews\Views;

use Livewire\WithPagination;

class TableView extends View
{
    use WithPagination;

    protected $updatesQueryString = [
        'search' => ['except' => ''],
        'filters'
    ];

    /** Component name */
    protected $view = 'table';

    /**
     * (Override) int Number of items to be showed,
     * @var int $paginate
     */
    protected $paginate = 20;

    /**
     * (Override) Headers to be showed on every coulumn
     * @var Array $headers
     */
    public $headers;

    /** @var int $total Total of items found */
    public $total = 0;

    /** @var String $search Current query string with the search value */
    public $search;

    /** @var String $filters Current query string with the filters value */
    public $filters = [];

    /** @var Array<BaseFilter> $filtersViews All filters customized in the child class */
    public $filtersViews;

    /** @var Array<String> $searchBy All fileds to search */
    public $searchBy;

    public function hydrate()
    {
        $this->filtersViews = $this->filters();
    }

    public function mount()
    {
        $this->headers = $this->headers();
        $this->search = request()->query('search', $this->search);
        $this->filtersViews = $this->filters();
        $this->filters = $this->getFiltersFromQueryString();
    }

    /**
     * Collects all data to be passed to the view, this includes the items searched on the database
     * through the filters, this data will be passed to livewire render method
     */
    protected function getRenderData()
    {
        /* dd($this->filters); */
        return [
            'items' => $this->getItems(),
            'actionsByRow' => $this->actionsByRow()
        ];
    }

    /**
     * Returns the itmes from the database regarding to the filters selected by the user
     * applies the search query, the filters uesed and the total of items found
     */
    private function getItems()
    {
        $query = $this->repository();

        $this->searchItem($query)
            ->applyFilters($query)
            ->updateTotal($query);

        return $query->paginate($this->paginate);
    }

    /**
     * Updates the total items found with the currect query
     *
     * @param $query Object Current query created by the filters
     */
    private function updateTotal($query)
    {
        $this->total = $query->count();

        return $this;
    }

    /**
     * Searchs an item by a query value, this search is executed when some filter or
     * the search value is changed
     *
     * @param $query Object Current query created by the filters
     */
    private function searchItem($query)
    {
        if ($this->search) {
            $fields = $this->searchBy;
            $value = $this->search;

            if ($value) {
                foreach ($fields as $field) {
                    if ($field === reset($fields)) {
                        $query->where($field, 'like', "%{$value}%");
                    } else {
                        $query->orWhere($field, 'like', "%{$value}%");
                    }
                }
            }
        }

        return $this;
    }

    /**
     * Applies every filter customized in the child class
     *
     * @param $query Object Current query created by the filters
     */
    private function applyFilters($query)
    {
        $filtersFromRequest = $this->filters;
        if ($filtersFromRequest && is_array($filtersFromRequest) && count($filtersFromRequest) > 0) {
            foreach ($this->filters() as $filter) {
                if (isset($filtersFromRequest[$filter->id])) {
                    /** Applies some transformation bwtween url query and filter class created */
                    $value = $filter->passValuesFromRequestToFilter($filtersFromRequest[$filter->id]);

                    if ($value != "") {
                        $filter->apply($query, $value, request());
                    }
                }
            }
        }

        return $this;
    }

    /**
     * Casts all boolean values of the querystring from string to boolean
     * this is needed to set the boolean filter values properly
     */
    private function getFiltersFromQueryString()
    {
        $filters = request()->query('filters', $this->filters);

        return collect($filters)->map(function ($filter) {
            /** If is an array that means it came from a boolean filter */
            if (is_array($filter)) {
                foreach ($filter as $option => $checked) {
                    /** Casts from string to boolean */
                    $filter[$option] = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
                }
            }

            return $filter;
        })->toArray();
    }

    /**
     * LIVEWIERE ACTIONS ARE HERE
     * All these actions are executed from the UI and those aren't for internal use
     */

    public function executeAction($action, $id)
    {
        $actionToExecute = collect($this->actionsByRow())->first(
            function ($actionToFind) use ($action) {
                return $actionToFind->id === $action;
            }
        );

        if ($actionToExecute) {
            $item = $this->repository()->find($id);
            $actionToExecute->execute($item, $id);
            session()->flash('message', $actionToExecute->messages($item)['sucess']);
        }
    }

    /**
     * Flushes all session messages about success and error statuses
     */
    public function flushMessage()
    {
        session()->forget('message');
    }
}
