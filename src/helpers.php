<?php

function admin($class)
{
    return $class->render();
}

function avatar($src)
{
    return view('laravel-views::components.img', [
        'src' => $src,
        'class' => 'h-8 w-8 object-cover rounded-full'
    ]);
}


function badge($title, $type = 'info')
{
    $types = ['success' => 'green', 'danger' => 'red', 'warning' => 'yellow', 'info' => 'blue', 'default' => 'gray'];

    return view('laravel-views::components.badge', [
        'title' => $title,
        'type' => $types[$type]
    ]);
}
