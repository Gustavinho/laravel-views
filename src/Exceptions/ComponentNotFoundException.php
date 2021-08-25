<?php

namespace LaravelViews\Exceptions;

class ComponentNotFoundException extends \Exception
{
    public function __construct($component, $class)
    {
        parent::__construct(
            "Component [\${$component}] not found for class: [{$class}]"
        );
    }
}
