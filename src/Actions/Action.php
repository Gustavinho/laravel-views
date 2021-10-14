<?php

namespace LaravelViews\Actions;

use Artificertech\LaravelRenderable\Concerns\IsRenderable;
use Artificertech\LaravelRenderable\Contracts\Renderable;
use LaravelViews\Actions\Concerns\AsLivewireAction;

abstract class Action implements Renderable
{
    use IsRenderable;
    use AsLivewireAction;

    /** @var String $title Title of the action */
    public $title;

    /** @var String $icon Feather icon name*/
    public $icon;

    /**
     * Variable name this object will have in the rendered component.
     *
     * @var string
     */
    public string $renderAs = 'action';

    /**
     * Get the blade component that will be used for this object.
     *
     * @return string
     */
    public function component()
    {
        return 'laravel-views::actions.action';
    }
}
