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

    public function getItemsProperty()
    {
        return $this->query;
    }

    /**
     * Clones the initial query (to avoid modifying it)
     * and get a model by an Id
     */
    public function getModelWhoFiredAction($id)
    {
        return (clone $this->initialQuery)->find($id);
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

        if ($this->paginate) {
            $query = $query->paginate($this->paginate);
        }
        return $query;
    }

    public function clickable()
    {
        return method_exists($this, 'itemOnClick');
    }
}
