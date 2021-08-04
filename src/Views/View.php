<?php

namespace LaravelViews\Views;

use Illuminate\Http\Request;
use LaravelViews\Views\Traits\WithDynamicComponents;
use Livewire\Component;

abstract class View extends Component
{
    use WithDynamicComponents;

    protected $view;
    public $viewName;

    public function render()
    {
        return view("laravel-views::{$this->view}");
    }

    public function getClassName()
    {
        return $this->viewName;
    }
}
