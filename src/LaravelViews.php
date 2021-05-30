<?php

namespace LaravelViews;

use Livewire\Livewire;

class LaravelViews
{
    private $view;
    private $layout = null;
    private $section = null;
    private $data = [];

    public function components()
    {
        // path => name
        return [
            'buttons.icon' => 'icon-button',
            'buttons.select' => 'select-button',
            'drop-down' => 'drop-down',
            'actions.actions' => 'actions',
            'actions.icon-and-title' => 'actions.icon-and-title',
            'actions.icon' => 'actions.icon',
            'attributes-list' => 'attributes-list',
            'alert' => 'alert',
            'alerts-handler' => 'alerts-handler',
            'form.input-group' => 'form.input-group',
            'icon' => 'icon'
        ];
    }

    public function create($view)
    {
        $this->view = $view;

        return $this;
    }

    public function layout($layout, $section = null, $data = [])
    {
        $this->layout = $layout;
        $this->section = $section;
        $this->data = $data;

        return $this;
    }

    public function section($section)
    {
        $this->section = $section;

        return $this;
    }

    public function data($data)
    {
        $this->data = $data;

        return $this;
    }

    public function css($options = '')
    {
        $assets = [
            'livewire' => Livewire::styles(),
            'tailwindcss' => '<link rel="stylesheet" href="' . asset('/vendor/tailwind.css') . '" />',
            'laravel-views' => '<link rel="stylesheet" href="' . asset('/vendor/laravel-views.css') . '" />'
        ];

        return $this->getCustomizedLinks($assets, $options);
    }

    public function js($options = '')
    {
        $assets = [
            'livewire' => Livewire::scripts(),
            'laravel-views' => '<script src="' . asset('/vendor/laravel-views.js') . '" type="text/javascript"></script>'
        ];

        return $this->getCustomizedLinks($assets, $options);
    }

    public function render()
    {
        $bladeFile = ($this->layout && $this->section) ? 'render-in-layout' : 'render';

        return view("laravel-views::core.{$bladeFile}", array_merge(
            [
                'view' => $this->view,
                'layout' => $this->layout,
                'section' => $this->section,
            ],
            $this->data
        ))->render();
    }

    private function getCustomizedLinks($assets = [], $options = '')
    {
        if ($options) {
            $options = explode(',', $options);
            $options[] = 'laravel-views';
            $links = [];

            foreach ($assets as $asset => $link) {
                if (in_array($asset, $options)) {
                    $links[] = $link;
                }
            }
        } else {
            $links = $assets;
        }

        return implode("\n", $links);
    }
}
