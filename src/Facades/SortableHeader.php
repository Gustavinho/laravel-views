<?php

namespace LaravelViews\Facades;

use Illuminate\Support\Facades\Facade;

class SortableHeader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sortable-header';
    }
}
