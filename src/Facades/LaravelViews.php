<?php

namespace Gustavinho\LaravelViews\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelViews extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-views';
    }
}
