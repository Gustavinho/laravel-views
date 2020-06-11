<?php

namespace Gustavinho\LaravelViews;

class Variants
{
    /** @var String component selected */
    private $component;

    /** @var String component's variant */
    private $variant;

    /**
     * Uses the button component
     *
     * @param String $variant component variant
     */
    public function button($variant = '')
    {
        $this->component = 'buttons';
        $this->variant = $variant;

        return $this;
    }

    /**
     * Uses the alert component
     *
     * @param String $variant component variant
     */
    public function alert($variant = '')
    {
        $this->component = 'alerts';
        $this->variant = $variant;

        return $this;
    }

    /**
     * Uses the paginator component
     *
     * @param String $variant component variant
     */
    public function paginator($variant = '')
    {
        $this->component = 'paginator';
        $this->variant = $variant;

        return $this;
    }

    /**
     * Get the class string for the component and variant selected
     *
     * @param String $element Set the internal element of the component if there are any
     */
    public function class($element = '')
    {
        $config = "laravel-views.{$this->component}.{$this->variant}";
        if ($element) {
            return config("{$config}.{$element}");
        }

        return config($config);
    }

    /**
     * Get the title of the variant and componente selected
     */
    public function title()
    {
        $titles = [
            'alerts' => [
                'success' => 'Success',
                'error' => 'Error',
                'warning' => 'Warning',
            ]
        ];

        return $titles[$this->component][$this->variant];
    }

    /**
     * Get the icon of the variant and componente selected
     */
    public function icon()
    {
        $icons = [
            'alerts' => [
                'success' => 'check',
                'error' => 'x',
                'warning' => 'alert-circle',
            ]
        ];

        return $icons[$this->component][$this->variant];
    }
}
