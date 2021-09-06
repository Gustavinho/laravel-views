<?php

namespace LaravelViews\Views\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use LaravelViews\Exceptions\ComponentNotFoundException;

trait WithConfigurableComponents
{
    protected $components = [];

    public function components($components)
    {
        $this->components = array_merge($this->components, $components);
    }

    public function component($component)
    {
        try {
            return $this->getComponentProperty($component);
        } catch (ComponentNotFoundException $e) {

            $configuration = 'laravel-views.components';

            if (property_exists($this, 'configSet')) {
                $configuration = implode('.', [$configuration, $this->configSet]);
            }

            $components = array_merge(config($configuration), $this->components);

            return Arr::get($components, $component) ?? Arr::get($components, $component);
        }
    }

    protected function getComponentProperty($component)
    {
        $studlyComponent = Str::finish(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $component))), 'Component');
        $componentPropertyName = lcfirst($studlyComponent);

        if (property_exists($this, $componentPropertyName)) return $this->$componentPropertyName;

        if (method_exists($this, $componentMethodName = 'get' . $studlyComponent)) {
            return app()->call([$this, $componentMethodName]);
        }

        throw new ComponentNotFoundException($component, static::class);
    }
}
