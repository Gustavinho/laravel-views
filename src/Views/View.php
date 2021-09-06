<?php

namespace LaravelViews\Views;

use LaravelViews\Views\Traits\WithActions;
use LaravelViews\Views\Traits\WithConfigurableComponents;
use Livewire\Component;

abstract class View extends Component
{
    use WithConfigurableComponents, WithActions;
}
