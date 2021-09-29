<?php

namespace LaravelViews\Actions;

use LaravelViews\Views\View;
use Illuminate\Support\Str;
use LaravelViews\Views\Traits\WithAlerts;

abstract class Action
{
    use WithAlerts;

    /** @var String $title Title of the action */
    public $title;
    
    /** @var String $icon Feather icon name*/
    public $icon;

    public $id;

    /** Item the action will be executed with */
    public $item;

    /**
     * Current view that executed the action
     * @var View $view
     */
    public $view;

    public function __construct()
    {
        $this->id = $this->getId();
    }

    public function isRedirect()
    {
        return get_class($this) === RedirectAction::class;
    }

    public function getId()
    {
        return Str::camelToDash((new \ReflectionClass($this))->getShortName());
    }

    public function renderIf($item, View $view)
    {
        return true;
    }

    public function shouldBeConfirmed()
    {
        return method_exists($this, 'getConfirmationMessage');
    }
}
