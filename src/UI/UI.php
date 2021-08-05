<?php

namespace LaravelViews\UI;

class UI
{
    public function badge($title, $type = 'default')
    {
        return $this->component('laravel-views::components.badge', [
            'title' => $title,
            'type' => $type
        ]);
    }

    public function avatar($src)
    {
        return $this->component('laravel-views::components.img', [
            'src' => $src,
            'variant' => 'avatar'
        ]);
    }

    public function link($title, $to)
    {
        return $this->component('laravel-views::components.link', compact(
            'to',
            'title'
        ));
    }

    public function icon($icon, $type = 'default', $class = "")
    {
        return $this->component('laravel-views::components.icon', compact(
            'icon',
            'type',
            'class'
        ));
    }

    public function propertyList($properties, $options = [])
    {
        return $this->component('laravel-views::components.property-list', array_merge(
            ['properties' => $properties],
            $options
        ));
    }

    public function component($view, $props = [])
    {
        return view('laravel-views::core.dynamic-component-view', [
            'view' => $view,
            'props' => $props,
        ]);
    }
}
