<?php

namespace LaravelViews\Views;

abstract class TableView extends CollectionView
{
    protected $collectionComponent = [
        'component' => 'laravel-views::table',
        'attributes' => [
            'class' => 'w-full'
        ],
    ];

    // Table Head Components
    protected $tableHeadComponent = [
        'component' => 'laravel-views::table.head',
        'attributes' => [
            'class' => 'border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left',
        ]
    ];

    protected $tableBulkActionsHeaderComponent = [
        'component' => 'laravel-views::table.header',
        'attributes' => [
            'class' => 'pl-3'
        ]
    ];

    protected $tableHeaderComponent = 'laravel-views::table.header';

    protected $tableActionsHeaderComponent = 'laravel-views::table.header';

    protected $tableHeadRowComponent = 'laravel-views::table.row';

    // Table Body Components
    protected $tableBodyComponent = [
        'component' => 'laravel-views::table.body',
        'attributes' => [
            'class' => 'text-sm'
        ]
    ];

    protected $tableBodyRowComponent = [
        'component' => 'laravel-views::table.row',
        'attributes' => [
            'class' => 'border-b border-gray-200'
        ]
    ];

    protected $tableBulkActionsCellComponent = [
        'component' => 'laravel-views::table.cell',
        'attributes' => [
            'class' => 'pl-3'
        ]
    ];

    protected $tableCellComponent = [
        'component' => 'laravel-views::table.cell',
        'attributes' => [
            'class' => 'px-3 py-2 whitespace-no-wrap'
        ]
    ];

    protected $tableActionsCellComponent = [
        'component' => 'laravel-views::table.cell',
        'attributes' => [
            'class' => 'px-3 py-2 flex justify-end'
        ]
    ];

    // No Results
    protected $noResultsComponent = [
        'component' => 'laravel-views::no-results',
        'attributes' => [
            'class' => 'flex justify-center items-center p-4'
        ]
    ];

    public function render()
    {
        return view('laravel-views::collection-view');
    }
}
