<?php

namespace LaravelViews\UI;

use Illuminate\View\ComponentAttributeBag;

class UI
{
    public function badge($title, $type = 'default', $attributes = [])
    {
        return $this->component(
            'laravel-views::components.badge',
            array_merge(
                compact(
                    'title',
                    'type',
                ),
                $attributes
            )
        );
    }

    public function avatar($src, $attributes = [])
    {
        return $this->image($src, 'avatar', $attributes);
    }

    public function image($src, $variant = '', $attributes = [])
    {
        return $this->component(
            'laravel-views::img',
            array_merge(
                compact(
                    'src',
                    'variant'
                ),
                $attributes
            )
        );
    }

    public function link($title, $to, $attributes = [])
    {
        return $this->component(
            'laravel-views::components.link',
            array_merge(
                compact(
                    'to',
                    'title'
                ),
                $attributes
            )
        );
    }

    public function icon($icon, $type = 'default', $attributes = [])
    {
        return $this->component(
            'laravel-views::icon',
            array_merge(
                compact(
                    'icon',
                    'type',
                ),
                $attributes
            )
        );
    }

    public function propertyList($properties, $attributes = [])
    {
        return $this->component(
            'laravel-views::property-list',
            array_merge(
                ['properties' => $properties],
                $attributes
            )
        );
    }

    public function component($component, $attributes = [])
    {
        return [
            'component' => $component,
            'attributes' =>  new ComponentAttributeBag($attributes)
        ];
    }
}
