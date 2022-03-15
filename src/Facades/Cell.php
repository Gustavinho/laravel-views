<?php

namespace LaravelViews\Facades;

use Illuminate\Support\Facades\Facade;

class Cell extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cell';
    }
}
