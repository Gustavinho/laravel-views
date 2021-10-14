<?php

namespace LaravelViews\Actions\Concerns;

trait AsLivewireAction
{
    public function alias()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}
