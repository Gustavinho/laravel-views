<?php

namespace Gustavinho\LaravelViews\Views;

use Illuminate\Http\Request;

class View
{
    protected $view;

    public function render()
    {
        $request = app('Illuminate\Http\Request');

        $data = array_merge(
            $this->getData($request),
            [
                'view' => $this
            ]
        );

        return view("laravel-views::{$this->view}", $data);
    }

    protected function getData(Request $request)
    {
        return [];
    }
}
