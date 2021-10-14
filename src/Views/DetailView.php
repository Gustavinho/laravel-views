<?php

namespace LaravelViews\Views;

use LaravelViews\Views\Concerns\WithActions;

abstract class DetailView extends View
{
    use WithActions;
    
    protected $modelClass;

    public $detailsComponent = 'laravel-views::details';

    public function render()
    {
        return view('laravel-views::detail-view');
    }
}
