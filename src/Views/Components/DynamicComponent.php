<?php

namespace LaravelViews\Views\Components;

use Illuminate\View\AnonymousComponent;

class DynamicComponent extends AnonymousComponent
{
    /**
     * Get the view / view contents that represent the component.
     *
     * @return string
     */
    public function render()
    {
        return view($this->view);
    }
}
