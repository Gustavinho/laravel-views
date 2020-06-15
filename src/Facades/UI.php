<?php

namespace Gustavinho\LaravelViews\Facades;

use Illuminate\Support\Facades\Facade;

class UI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ui';
    }
}
