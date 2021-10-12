<?php

namespace LaravelViews\Views;

class ListView extends CollectionView
{
    public $collectionComponent = 'laravel-views::list';

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
