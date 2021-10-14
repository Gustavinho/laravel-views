<?php

namespace LaravelViews\Views;

use Illuminate\Pagination\LengthAwarePaginator;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\BulkAction;
use LaravelViews\Views\Concerns\WithBulkActions;
use LaravelViews\Views\Concerns\WithFilters;
use LaravelViews\Views\Concerns\WithSearch;
use LaravelViews\Views\Concerns\WithSorting;
use Livewire\WithPagination;

abstract class CollectionView extends View
{
    use WithPagination,
        WithFilters,
        WithSearch,
        WithSorting,
        WithBulkActions;

    /**
     * (Override) int Number of items to be showed,
     * @var int $paginate
     */
    protected $paginate = 20;

    public function getItemsProperty()
    {
        return $this->query;
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

    public function executing($key, Action $action)
    {
        if (!($action instanceof BulkAction))
            return [$this->items->get($key)];
    }
}
