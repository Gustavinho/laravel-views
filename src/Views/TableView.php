<?php

namespace LaravelViews\Views;

use LaravelViews\UI\Header;

abstract class TableView extends DataView
{
    public $collectionComponent = 'laravel-views::table';
    public $tableHeadComponent = 'laravel-views::table-head';
    public $tableBodyComponent = 'laravel-views::table-body';
    public $tableCellComponent = 'laravel-views::table-cell';

    public function render()
    {
        return view('laravel-views::collection-view');
    }
}
