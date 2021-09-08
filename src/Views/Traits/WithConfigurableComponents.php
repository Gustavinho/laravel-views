<?php

namespace LaravelViews\Views\Traits;

use Artificertech\LaravelRenderable\Contracts\Renderable;
use Illuminate\Support\Str;
use LaravelViews\Exceptions\ComponentNotFoundException;
use LaravelViews\Facades\UI;

trait WithConfigurableComponents
{
    public function component($component)
    {
        try {
            $componentConfig = $this->getLocalConfiguration($component);
        } catch (ComponentNotFoundException $e) {
            $componentConfig = config("laravel-views.components.{$component}", null);

            if (is_null($componentConfig)) return null;
        }

        if ($componentConfig instanceof Renderable) {
            return $componentConfig;
        }

        if (is_string($componentConfig)) {
            return UI::component($componentConfig);
        }

        return UI::component($componentConfig['component'], $componentConfig['attributes'] ?? []);
    }

    protected function getLocalConfiguration($component)
    {
        $camelComponent = (string) Str::of($component)->replace('-', '_')->camel()->finish('Component');

        if (property_exists($this, $camelComponent)) return $this->$camelComponent;

        if (method_exists($this, $camelComponent)) return $this->$camelComponent();

        throw new ComponentNotFoundException($component, static::class);
    }
}
