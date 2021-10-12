<?php

namespace LaravelViews\Views;

use Illuminate\Pagination\LengthAwarePaginator;
use LaravelViews\Views\Traits\WithFilters;
use LaravelViews\Views\Traits\WithSearch;
use LaravelViews\Views\Traits\WithSorting;
use Livewire\WithPagination;

abstract class CollectionView extends View
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
    public function getItemThatFiredAction($key)
    {
        $data = clone $this->initialData;
        if ($data instanceof \Illuminate\Database\Eloquent\Builder)
            return $data->find($key);
        else {
            return $data->get($key);
        }
    }

    public function getInitialDataProperty()
    {
        if (method_exists($this, 'data')) {
            return $this->data();
        }

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
        $data = clone $this->initialData;

        $this->applySearch($data)
            ->applyFilters($data)
            ->applySorting($data)
            ->applyPagination($data);

        return $data;
    }

    protected function applyPagination(&$data)
    {
        if ($this->paginate) {
            if ($data instanceof \Illuminate\Database\Eloquent\Builder) {
                $key = $data->getModel()->getKeyName();

                $data =  $data->paginate($this->paginate);

                $data->setCollection($data->keyBy($key));
            } else {
                $results = $data->forPage($this->page, $this->paginate);
                $data = new LengthAwarePaginator($results, $data->count(), $this->paginate, $this->page);
            }
        }

        return $this;
    }
}
