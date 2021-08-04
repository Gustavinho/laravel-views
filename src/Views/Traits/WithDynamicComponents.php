<?php

namespace LaravelViews\Views\Traits;

use Illuminate\Support\Arr;
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
            $components = array_merge(config('laravel-views.components'), $this->components());

            return Arr::get($components, $component) ?? $this->getComponent($defaultComponent);
        }
    }

    protected function getComponentProperty($component)
    {
        $studlyComponent = Str::finish(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $component))), 'Component');
        $componentPropertyName = lcfirst($studlyComponent);

        foreach ([$this, $this->getView()] as $componentable) {
            if (is_null($componentable)) continue;

            $exists = property_exists($componentable, $componentPropertyName);
            if (property_exists($componentable, $componentPropertyName)) return $componentable->$componentPropertyName;

            if (method_exists($componentable, $componentMethodName = 'get' . $studlyComponent)) {
                return app()->call([$componentable, $componentMethodName]);
            }
        }

        throw new PropertyNotFoundException($component, static::class);
    }

    protected function getView()
    {
        return null;
    }
}
