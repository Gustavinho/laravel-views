<?php

use Gustavinho\LaravelViews\Variants;

function admin($class)
{
    return $class->render();
}

function avatar($src)
{
    return view('laravel-views::components.img', [
        'src' => $src,
        'variant' => 'avatar'
    ]);
}

function badge($title, $type = 'info')
{
    return view('laravel-views::components.badge', [
        'title' => $title,
        'type' => $type
    ]);
}

function attributes($attributes = null)
{
    $attributesStr = '';
    if ($attributes) {
        foreach ($attributes as $attribute => $attrValue) {
            if ($attribute) {
                $attributesStr .= "$attribute = $attrValue ";
            } else {
                $attributesStr .= $attrValue . ' ';
            }
        }
    }

    return $attributesStr;
}

function variants()
{
    return new Variants;
}
