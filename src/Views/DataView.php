<?php

namespace LaravelViews\Views;

use LaravelViews\Views\Traits\WithFilters;
use LaravelViews\Views\Traits\WithSearch;
use LaravelViews\Views\Traits\WithSorting;
use Livewire\WithPagination;

abstract class DataView extends View
{
    use WithPagination,
        WithFilters,
        WithSearch,
        WithSorting;

    /**
     * (Override) int Number of items to be showed,
     * @var int $paginate
     */
    protected $paginate = 20;

    /** @var int $total Total of items found */
    public $total = 0;

    public $selected = [];
    public $allSelected = false;

    public function getItemsProperty()
    {
        return $this->query;
    }

    protected function appCallData()
    {
        return ['items' => $this->items];
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
    public function getQueryProperty()
    {
        $query = clone $this->initialQuery;
        $query = $this->applySearch($query);
        $query = $this->applyFilters($query);
        $query = $this->applySorting($query);

        return $query->paginate($this->paginate);
    }
}
