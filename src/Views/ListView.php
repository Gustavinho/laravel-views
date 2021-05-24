<?php

namespace LaravelViews\Views;

use Illuminate\Support\Collection;

class ListView extends DataView
{
    /** Component name */
    protected $view = 'list-view.list-view';

    public $itemComponent = 'laravel-views::list-view.list-item';

    /**
     * Collects all data to be passed to the view, this includes the items searched on the database
     * through the filters, this data will be passed to livewire render method
     */
    protected function getRenderData()
    {
        $data = parent::getRenderData();
        $data['sortableBy'] =  ($sortableBy = $this->sortableBy()) instanceof Collection
            ? $sortableBy
            : collect($sortableBy);

        return $data;
    }

    public function sortableBy()
    {
        return [];
    }
}
