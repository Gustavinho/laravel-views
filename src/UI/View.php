<?php

namespace LaravelViews\UI;

class View
{
    public $view;
    public $props;

    public function __construct($view, $props)
    {
        $this->view = $view;
        $this->props = $props;
    }
}
