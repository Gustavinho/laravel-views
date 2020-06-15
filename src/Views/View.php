<?php

namespace LaravelViews\Views;

use Illuminate\Http\Request;
use Livewire\Component;

abstract class View extends Component
{
    protected $view;

    public function render()
    {
        $data = array_merge(
            $this->getRenderData(),
            [
                'view' => $this
            ]
        );

        return view("laravel-views::{$this->view}", $data);
    }

    abstract protected function getRenderData();
}
