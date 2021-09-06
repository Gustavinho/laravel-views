<?php

namespace LaravelViews\Views;

class ListView extends DataView
{
    public function render()
    {
        return view('laravel-views::list-view.list-view');
    }
}
