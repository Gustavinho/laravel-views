<?php

namespace Gustavinho\LaravelViews\Actions;

abstract class Action
{
    /** @var String $title Title of the action */
    public $title;

    /** @var String $icon Feather icon name*/
    public $icon;

    public $id;

    public function __construct()
    {
        $this->id = $this->getId();
    }

    public function isRedirect()
    {
        return get_class($this) === RedirectAction::class;
    }

    public function messages($item)
    {
        return [
            'success' => 'Action was executed successfully',
            'error' => 'There was an error executing this action',
        ];
    }

    public function getId()
    {
        return $this->camelToDashCase((new \ReflectionClass($this))->getShortName());
    }

    private function camelToDashCase($camelStr)
    {
        return strtolower(preg_replace('%([a-z])([A-Z])%', '\1-\2', $camelStr));
    }

    public function renderIf($item)
    {
        return true;
    }

    abstract public function execute($item, $id);
}
