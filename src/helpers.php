<?php

use LaravelViews\UI\Variants;

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

if (!function_exists('variants')) {
    function variants()
    {
        return new Variants;
    }
}
