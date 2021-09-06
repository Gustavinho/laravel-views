<?php

namespace LaravelViews\Views;

use Illuminate\Support\Arr;
use LaravelViews\Facades\UI;
use LaravelViews\Views\Traits\WithSortableDropdown;

abstract class ItemView extends DataView
{
    public function getItemActionProperty()
    {
        return method_exists($this, 'onItemClick');
    }
}
