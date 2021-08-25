<?php

namespace LaravelViews\Views;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use LaravelViews\Facades\UI;
use LaravelViews\Views\Traits\WithActions;
use LaravelViews\Views\Traits\WithDynamicComponents;
use Livewire\Component;

abstract class View extends Component
{
    use WithDynamicComponents, WithActions;

    protected $view;
    public $viewName;

    public function render()
    {
        return view($this->view);
    }

    public function getClassName()
    {
        return $this->viewName;
    }

    public function getHeaderProperty()
    {
        if (method_exists($this, 'header')) {
            $header = app()->call([$this, 'header'], $this->appCallData());


            if (is_array($header)) {
                // If there is an array of data insted of a component
                // then creates a new attributes component
                if (!Arr::isAssoc($header)) {
                    $header = array_combine(['title', 'subtitle'], $header);
                }

                $header = UI::component('laravel-views::components.header', $header);
            }

            return $header;
        }

        return null;
    }

    abstract protected function appCallData();
}
