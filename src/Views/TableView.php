<?php

namespace Gustavinho\LaravelViews\Views;

use Illuminate\Http\Request;
use Livewire\WithPagination;

class TableView extends View
{
    use WithPagination;

    protected $updatesQueryString = ['search'];

    private $query;

    protected $view = 'table';

    protected $paginate = 10;

    protected $repository = null;

    public $searchBy;

    public $headers;

    public $total;

    public $search;

    public function hydrate()
    {
        $this->query = $this->repository();
    }

    public function mount()
    {
        $this->query = $this->repository();

        /** Sets the headers from the child class */
        $this->headers = $this->headers();
        $this->search = request()->query('search', $this->search);

        $this->searchItem();
    }

    /**
     * Collects all data to be passed to the view,
     * this include the items searched on the database
     * through the filters
     */
    protected function getData(Request $request)
    {
        $this->updateTotal();

        return [
            'items' => $this->query->paginate($this->paginate),
            'fieldsToSearch' => $this->getTableFiltersView(),
        ];
    }

    private function getTableFiltersView()
    {
        /* $tableFiltersView = new TableFiltersView();
        $tableFiltersView->setFieldsToSearch($this->searchBy)
            ->setFilters($this->filters());

        return $tableFiltersView; */
    }

    public function filters()
    {
        return null;
    }

    private function applyFilters($request, $query)
    {
        if ($request->has('filters')) {
            $filtersFromRequest = $request->get('filters');

            foreach ($this->filters() as $filter) {
                if (isset($filtersFromRequest[$filter->id])) {
                    $filter->apply(
                        $query,
                        $filter->passValuesFromRequestToFilter($filtersFromRequest[$filter->id]),
                        $request
                    );
                }
            }
        }
    }

    public function filter()
    {
        $this->searchItem();
    }

    protected function updateTotal()
    {
        $this->total = $this->query->count();
    }

    /**
     * Searchs an item by a query value, this search
     * is executed when the component is mounted and every time
     * the search form is sent
     */
    private function searchItem()
    {
        if ($this->search) {
            $fields = $this->searchBy;
            $value = $this->search;

            if ($value) {
                // dd($value);
                foreach ($fields as $field) {
                    if ($field === reset($fields)) {
                        $this->query->where($field, 'like', "%{$value}%");
                    } else {
                        $this->query->orWhere($field, 'like', "%{$value}%");
                    }
                }
            }
        }
    }
}
