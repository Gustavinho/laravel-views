<?php

namespace LaravelViews\UI;

class UI
{
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
}
