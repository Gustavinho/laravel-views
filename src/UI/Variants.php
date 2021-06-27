<?php

namespace LaravelViews\UI;

class Variants
{
    /** @var String component selected */
    private $component;

    /** @var String component's variant */
    private $variant;

    private $path = null;

    public function __construct($path = null)
    {
        $this->path = $path;
    }

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
     * Uses the badge component
     *
     * @param String $variant component variant
     */
    public function badge($variant = '')
    {
        $this->component = 'badges';
        $this->variant = $variant;

        return $this;
    }

    /**
     * Uses the img component
     *
     * @param String $variant component variant
     */
    public function img($variant = '')
    {
        $this->component = 'images';
        $this->variant = $variant;

        return $this;
    }

    /**
     * Uses the icon component
     *
     * @param String $variant component variant
     */
    public function featherIcon($variant = '')
    {
        $this->component = 'icons';
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
        // Returns the config path directly it it was set in the constructor
        if ($this->path) {
            return config("laravel-views.{$this->path}");
        } else {
            $config = "laravel-views.{$this->component}.{$this->variant}";
            if ($element) {
                return config("{$config}.{$element}");
            }

            return config($config);
        }
    }

    /**
     * Get the title of the variant and componente selected
     */
    public function title()
    {
        $titles = [
            'alerts' => [
                'success' => 'Success',
                'danger' => 'Error',
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
                'danger' => 'x',
                'warning' => 'alert-circle',
            ]
        ];

        return $icons[$this->component][$this->variant];
    }
}
