<?php

namespace LaravelViews\Views;

use LaravelViews\Data\Contracts\Filterable;
use LaravelViews\Data\Contracts\Searchable;
use LaravelViews\Data\Contracts\Sortable;
use LaravelViews\Data\QueryStringData;
use LaravelViews\Views\Traits\WithFilters;
use Livewire\WithPagination;

abstract class DataView extends View
{
    use WithPagination, WithFilters;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy',
        'sortOrder'
    ];

    /**
     * (Override) int Number of items to be showed,
     * @var int $paginate
     */
    protected $paginate = 20;

    /** @var int $total Total of items found */
    public $total = 0;

    /** @var String $search Current query string with the search value */
    public $search;


    /** @var Array<String> $searchBy All fields to search */
    public $searchBy;

    public $sortBy = null;

    public $sortOrder = 'asc';

    public $selected = [];
    public $allSelected = false;

    public function mount(QueryStringData $queryStringData)
    {
        $this->search = $queryStringData->getSearchValue($this->search);

        $this->sortBy = $queryStringData->getValue('sortBy', $this->sortBy);
        $this->sortOrder = $queryStringData->getValue('sortOrder', $this->sortOrder);
    }

    public function getItemsProperty()
    {
        return $this->query;
    }

    protected function appCallData()
    {
        return ['items' => $this->items];
    }

    /**
     * Reset pagination
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Clones the initial query (to avoid modifying it)
     * and get a model by an Id
     */
    public function getModelWhoFiredAction($id)
    {
        return (clone $this->initialQuery)->find($id);
    }

    public function updatedAllSelected($value)
    {
        $this->selected = $value ? $this->query->pluck('id')->map(function ($id) {
            return (string)$id;
        })->toArray() : [];
    }

    public function getInitialQueryProperty()
    {
        if (method_exists($this, 'repository')) {
            return $this->repository();
        }
        return $this->model::query();
    }

    /**
     * Returns the items from the database regarding to the filters selected by the user
     * applies the search query, the filters used and the total of items found
     */
    public function getQueryProperty(Searchable $searchable, Filterable $filterable, Sortable $sortable)
    {
        $query = clone $this->initialQuery;
        $query = $searchable->searchItems($query, $this->searchBy, $this->search);
        $query = $this->applyFilters($query);
        $query = $sortable->sortItems($query, $this->sortBy, $this->sortOrder);

        return $query->paginate($this->paginate);
    }


    /**
     * LIVEWIERE ACTIONS ARE HERE
     * All these actions are executed from the UI and those aren't for internal use
     */

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

    public function clearSearch()
    {
        $this->search = '';
    }
}
