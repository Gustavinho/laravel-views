<?php

namespace Gustavinho\LaravelViews\Views;

use Illuminate\Http\Request;

class TableView extends View
{
    protected $view = 'table';
    protected $paginate = 10;
    protected $repository = null;
    protected $searchBy = null;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    /**
     * Collects all data to be passed to the view,
     * this include the items searched on the database through the filters
     */
    protected function getData(Request $request)
    {
        $query = $this->collection($this->repository);

        $this->applySearch($request, $query);
        $this->applyFilters($request, $query);

        return [
            'headers' => $this->headers(),
            'items' => $query->paginate($this->paginate),
            'total' => $query->count(),
            'tableFiltersView' => $this->getTableFiltersView(),
        ];
    }

    private function getTableFiltersView()
    {
        $tableFiltersView = new TableFiltersView();
        $tableFiltersView->setFieldsToSearch($this->searchBy)
            ->setFilters($this->filters());

        return $tableFiltersView;
    }

    public function collection($repository)
    {
        return $repository;
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

    private function applySearch($request, $query)
    {
        if ($request->has('query')) {
            $fields = $this->searchBy;
            $value = $request->get('query');

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
    }
}
