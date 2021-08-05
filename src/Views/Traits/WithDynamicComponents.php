<?php

namespace LaravelViews\Views\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Exceptions\PropertyNotFoundException;

trait WithDynamicComponents
{
    protected function components(): array
    {
        return [];
    }

    public function getComponent($component, $defaultComponent = null)
    {
        if (is_null($component)) return null;

        try {
            return $this->getComponentProperty($component);
        } catch (PropertyNotFoundException $e) {
            if (!is_null($this->componentParent())) {
                return $this->componentParent()?->getComponent($component, $defaultComponent);
            }

            $components = array_merge(config('laravel-views.components'), $this->components());

            return Arr::get($components, $component) ?? $this->getComponent($defaultComponent);
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

        throw new PropertyNotFoundException($component, static::class);
    }

    protected function componentParent()
    {
        return null;
    }
}
