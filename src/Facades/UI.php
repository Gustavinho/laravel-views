<?php

namespace LaravelViews\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string component($view, $data)
 * @method static string attributes($data)
 *
 * @see \LaravelViews\UI\UI
 */
class UI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ui';
    }
}
