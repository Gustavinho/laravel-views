<?php

namespace LaravelViews\Views\Traits;

use Illuminate\Support\Str;
use Illuminate\View\ComponentAttributeBag;
use LaravelViews\Exceptions\ComponentNotFoundException;

trait WithConfigurableComponents
{
    public function component($component)
    {
        return $this->componentConfiguration($component)['component'];
    }

    public function componentAttributes($component)
    {
        return $this->componentConfiguration($component)['attributes'];
    }

    protected function componentConfiguration($component)
    {
        try {
            $componentConfig = $this->getLocalConfiguration($component);
        } catch (ComponentNotFoundException $e) {
            $componentConfig = config("laravel-views.components.{$component}", null);

            if (is_null($componentConfig)) return ['component' => null, 'attributes' => null];
        }

        if (is_string($componentConfig)) {
            return [
                'component' => $componentConfig,
                'attributes' => null
            ];
        }

        $componentConfig['attributes'] = new ComponentAttributeBag($componentConfig['attributes'] ?? []);

        return $componentConfig;
    }

    protected function getLocalConfiguration($component)
    {
        $camelComponent = (string) Str::of($component)->replace('-', '_')->camel()->finish('Component');

        if (property_exists($this, $camelComponent)) return $this->$camelComponent;

        if (method_exists($this, $camelComponent)) return $this->$camelComponent();

        throw new ComponentNotFoundException($component, static::class);
    }
}
