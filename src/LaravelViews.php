<?php

namespace Gustavinho\LaravelViews;

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
        return view("laravel-views::core.css")->render();
    }

    public function js()
    {
        return view("laravel-views::core.js")->render();
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
