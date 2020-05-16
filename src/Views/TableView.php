<?php

namespace Gustavinho\LaravelViews\Views;

use Gustavinho\LaravelViews\Data\Contracts\Filterable;
use Gustavinho\LaravelViews\Data\Contracts\Searchable;
use Gustavinho\LaravelViews\Data\QueryStringData;
use Livewire\WithPagination;

abstract class TableView extends View
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

    /** @var int $total Total of items found */
    public $total = 0;

    /** @var String $search Current query string with the search value */
    public $search;

    /** @var String $filters Current query string with the filters value */
    public $filters = [];

    /** @var Array<BaseFilter> $filtersViews All filters customized in the child class */
    private $filtersViews;

    /** @var Array<String> $searchBy All fileds to search */
    public $searchBy;

    public function hydrate()
    {
        $this->filtersViews = $this->filters();
    }

    public function mount(QueryStringData $queryStringData)
    {
        $this->filtersViews = $this->filters();
        $this->search = $queryStringData->getSearchValue($this->search);
        $this->filters = $queryStringData->getFilterValues($this->filters);
    }

    /**
     * Collects all data to be passed to the view, this includes the items searched on the database
     * through the filters, this data will be passed to livewire render method
     */
    protected function getRenderData()
    {
        /* dd($this->filters); */
        return [
            'headers' => $this->headers(),
            'items' => $this->getItems(),
            'actionsByRow' => $this->actionsByRow()
        ];
    }

    /**
     * Returns the itmes from the database regarding to the filters selected by the user
     * applies the search query, the filters uesed and the total of items found
     */
    // TODO: Move this querybuilding to another class
    private function getItems()
    {
        $query = $this->repository();
        $searchable = app(Searchable::class);
        $filterable = app(Filterable::class);

        $query = $searchable->searchItems($query, $this->searchBy, $this->search);
        $query = $filterable->applyFilters($query, $this->filters(), $this->filters);

        /** Updates the total items found with the currect query */
        $this->total = $query->count();

        return $query->paginate($this->paginate);
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

    protected function filters()
    {
        return [];
    }

    protected function actionsByRow()
    {
        return [];
    }
}
