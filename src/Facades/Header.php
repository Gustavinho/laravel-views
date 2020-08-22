<?php

namespace LaravelViews\Facades;

use Illuminate\Support\Facades\Facade;

class Header extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'header';
    }
}
