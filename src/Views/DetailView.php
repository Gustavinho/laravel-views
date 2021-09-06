<?php

namespace LaravelViews\Views;

abstract class DetailView extends View
{
    protected $modelClass;

    public $model;

    public $detailsComponent = 'laravel-views::details';

    public function render()
    {
        return view('laravel-views::detail-view');
    }

    public function getModelWhoFiredAction()
    {
        return $this->model;
    }
}
