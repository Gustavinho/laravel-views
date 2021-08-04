<?php

namespace LaravelViews\Views\Components;

use Illuminate\View\AnonymousComponent;
use Illuminate\View\Component;

class DynamicComponent extends Component
{
    /**
     * The component view.
     *
     * @var string
     */
    protected $view;

    /**
     * The component data.
     *
     * @var array
     */
    protected $props = [];

    /**
     * Create a new DynamicView component instance.
     *
     * @param  string  $view
     * @param  array  $props
     * @return void
     */
    public function __construct($view, $props)
    {
        $this->view = $view;
        $this->props = $props;
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return string
     */
    public function render()
    {
        return $this->view;
    }

    /**
     * Get the data that should be supplied to the view.
     *
     * @author Freek Van der Herten
     * @author Brent Roose
     *
     * @return array
     */
    public function data()
    {
        return array_merge($this->props, parent::data());
    }
}
