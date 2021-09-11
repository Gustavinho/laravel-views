<?php

namespace LaravelViews\UI;

use Artificertech\LaravelRenderable\Facades\Renderable as RenderableFacade;
use Artificertech\LaravelRenderable\Renderable;
use Artificertech\LaravelRenderable\RenderableComponent;

Renderable::macro('badge', function ($title, $type = 'default', $attributes = []) {
    return new RenderableComponent(
        'laravel-views::badge',
        array_merge(
            compact(
                'title',
                'type',
            ),
            $attributes
        )
    );
});

Renderable::macro('image', function ($src, $variant = '', $attributes = []) {
    return new RenderableComponent(
        'laravel-views::img',
        array_merge(
            compact(
                'src',
                'variant'
            ),
            $attributes
        )
    );
});

Renderable::macro('avatar', function ($src, $attributes = []) {
    return RenderableFacade::image($src, 'avatar', $attributes);
});

Renderable::macro('link', function ($title, $to, $attributes = []) {
    return new RenderableComponent(
        'laravel-views::link',
        array_merge(
            compact(
                'to',
                'title'
            ),
            $attributes
        )
    );
});

Renderable::macro('icon', function ($icon, $type = 'default', $attributes = []) {
    return new RenderableComponent(
        'laravel-views::icon',
        array_merge(
            compact(
                'icon',
                'type',
            ),
            $attributes
        )
    );
});

Renderable::macro('propertyList', function ($properties, $attributes = []) {
    return new RenderableComponent(
        'laravel-views::icon',
        array_merge(
            ['properties' => $properties],
            $attributes
        )
    );
});
