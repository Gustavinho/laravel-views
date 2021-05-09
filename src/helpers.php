<?php

use LaravelViews\UI\Variants;

if (!function_exists('variants')) {
    function variants($path = null)
    {
        $variants = new Variants($path);
        if ($path) {
            return $variants->class();
        }

        return $variants;
    }
}
