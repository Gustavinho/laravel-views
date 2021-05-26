<?php

namespace LaravelViews\UI;

use Illuminate\Support\Facades\View;

class UI
{
    public function editable($model, $field)
    {
        return view('laravel-views::components.editable', [
            'model' => $model,
            'field' => $field,
        ])->render();
    }

    public function badge($title, $type = 'default')
    {
        return view('laravel-views::components.badge', [
            'title' => $title,
            'type' => $type
        ])->render();
    }

    public function avatar($src)
    {
        return view('laravel-views::components.img', [
            'src' => $src,
            'variant' => 'avatar'
        ])->render();
    }

    public function link($title, $to)
    {
        return view('laravel-views::components.link', compact(
            'to',
            'title'
        ))->render();
    }

    public function icon($icon, $type = 'default', $class = "")
    {
        return view('laravel-views::components.icon', compact(
            'icon',
            'type',
            'class'
        ))->render();
    }

    public function attributes($attributes, $options = [])
    {
        return $this->component('laravel-views::components.attributes-list', array_merge(
            ['data' => $attributes],
            $options
        ));
    }

    public function component($view, $data)
    {
        return View::make('laravel-views::core.dynamic-component')
            ->with([
                'view' => $view,
                'data' => $data,
            ])
            ->render();
    }
}
