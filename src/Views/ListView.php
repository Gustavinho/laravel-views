<?php

namespace LaravelViews\Views;

class ListView extends DataView
{
    public $collectionComponent = 'laravel-views::list';

    public function render()
    {
        return view('laravel-views::collection-view');
    }
}
