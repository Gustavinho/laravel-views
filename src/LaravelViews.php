<?php

namespace Gustavinho\LaravelViews;

use Livewire\Livewire;

class LaravelViews
{
    private $view;
    private $layout = null;
    private $section = null;
    private $data = [];

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

    public function css()
    {
        return \Livewire\Livewire::styles()."\n"
            .'<link rel="stylesheet" href="http://test-packages.test/vendor/laravel-views.css" />';
    }

    public function js()
    {
        return \Livewire\Livewire::scripts()."\n".
            '<script src="http://test-packages.test/vendor/laravel-views.js" type="text/javascript"></script>';
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
}
