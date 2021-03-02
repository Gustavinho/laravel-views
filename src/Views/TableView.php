<?php

namespace LaravelViews\Views;

abstract class TableView extends DataView
{
    /** Component name */
    protected $view = 'table-view.table-view';

    /**
     * Collects all data to be passed to the view, this includes the items searched on the database
     * through the filters, this data will be passed to livewire render method
     */
    protected function getRenderData()
    {
        $data = parent::getRenderData();
        $data['headers'] = $this->headers();

        return $data;
    }
}
