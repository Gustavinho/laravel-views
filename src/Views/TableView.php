<?php

namespace LaravelViews\Views;

use Exception;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\ExecuteAction;
use LaravelViews\Data\Contracts\Filterable;
use LaravelViews\Data\Contracts\Searchable;
use LaravelViews\Data\Contracts\Sortable;
use LaravelViews\Data\QueryStringData;
use Livewire\WithPagination;

abstract class TableView extends View
{
    use WithPagination;

    protected $updatesQueryString = [
        'search' => ['except' => ''],
        'filters'
    ];

    /** Component name */
    protected $view = 'table-view.table-view';

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
    public $filtersViews;

    /** @var Array<String> $searchBy All fields to search */
    public $searchBy;

    /** @var String $confirmationMessage sets the confirmation message to be shown when an action requires it */
    public $confirmationMessage = null;

    /** @var Action $actionToBeConfirmed sets a temporal action to be executed once it will be confirmed */
    public $actionToBeConfirmed = null;

    public $sortBy = null;

    public $sortOrder = 'asc';

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
        return [
            'headers' => $this->headers(),
            'items' => $this->getItems(),
            'actionsByRow' => $this->actionsByRow()
        ];
    }

    /**
     * Returns the itmes from the database regarding to the filters selected by the user
     * applies the search query, the filters used and the total of items found
     */
    // TODO: Move this querybuilding to another class
    private function getItems()
    {
        $query = $this->repository();
        $searchable = app(Searchable::class);
        $filterable = app(Filterable::class);
        $sortable = app(Sortable::class);

        $query = $searchable->searchItems($query, $this->searchBy, $this->search);
        $query = $filterable->applyFilters($query, $this->filters(), $this->filters);
        $query = $sortable->sortItems($query, $this->sortBy, $this->sortOrder);

        /** Updates the total items found with the correct query */
        $this->total = $query->count();

        return $query->paginate($this->paginate);
    }

    protected function filters()
    {
        return [];
    }

    protected function actionsByRow()
    {
        return [];
    }

    /**
     * LIVEWIERE ACTIONS ARE HERE
     * All these actions are executed from the UI and those aren't for internal use
     */

    /**
     * Sets the filed the table view data will be sort by
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

    public function executeAction($action, $id, $shouldVerifyConfirmation, ExecuteAction $executeAction)
    {
        $item = $this->repository()->find($id);

        /** Executes the action, if it needs to be confirmed it will return the action to be confirmed  */
        $actionToBeConfirmed = $executeAction
            ->shouldVerifyConfirmation($shouldVerifyConfirmation)
            ->callByActionName($action, $item, $this->actionsByRow());

        /** If the action need to be confirmed */
        if ($actionToBeConfirmed) {
            $this->fill([
                /** Stores action id and item id to be executed before, this is needed on the confirmation message component */
                'actionToBeConfirmed' => [$actionToBeConfirmed->id, $item->id,],
                'confirmationMessage' => $actionToBeConfirmed->getConfirmationMessage($item)
            ]);
        } else {
            $this->closeConfirmationMessage();
        }
    }

    /**
     * Flushes all session messages about success and error statuses
     */
    public function flushMessage()
    {
        session()->forget('message');
        session()->forget('messageType');
    }

    public function clearFilters()
    {
        $this->filters = [];
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function closeConfirmationMessage()
    {
        $this->confirmationMessage = null;
        $this->actionToBeConfirmed = null;
    }
}
