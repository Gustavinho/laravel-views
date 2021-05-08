<?php

use LaravelViews\UI\Variants;

if (!function_exists('variants')) {
    function variants()
    {
        return new Variants;
    }
}
