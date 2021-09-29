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
            'buttons.button' => 'button',
            'dropdown.drop-down' => 'drop-down',
            'dropdown.header' => 'drop-down.header',
            'actions.responsive' => 'actions',
            'actions.drop-down' => 'actions.drop-down',
            'actions.icon-and-title' => 'actions.icon-and-title',
            'actions.icon' => 'actions.icon',
            'attributes-list' => 'attributes-list',
            'alert' => 'alert',
            'alerts-handler' => 'alerts-handler',
            'form.input-group' => 'form.input-group',
            'icon' => 'icon',
            'modal' => 'modal',
            'form.checkbox' => 'checkbox',
            'form.input' => 'input',
            'tooltip' => 'tooltip',
            'confirmation-message' => 'confirmation-message',
            'loading' => 'loading'
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
            'alpine' => '<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>',
            'laravel-views' => '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script src="' . asset('/vendor/laravel-views.js') . '" type="text/javascript" defer></script>'
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

        $linksStr = implode(PHP_EOL, $links);
        return <<<HTML
{$linksStr}
HTML;
    }
}
