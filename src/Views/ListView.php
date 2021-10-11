<?php

namespace LaravelViews\Views;

class ListView extends CollectionView
{
    public $collectionComponent = 'laravel-views::list';

    public function render()
    {
        return view('laravel-views::collection-view');
    }
}
