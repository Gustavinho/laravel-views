<?php

namespace LaravelViews\Actions;

abstract class Action
{
    /** @var String $title Title of the action */
    public $title;

    /** @var String $tooltip Tooltip of the action */
    public $tooltip;

    /** @var String $icon Feather icon name*/
    public $icon;

    public $id;

    /** Item the action will be executed with */
    public $item;

    private $messages = [
        'success' => 'Action was executed successfully',
        'danger' => 'There was an error executing this action',
    ];

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

    public function success($message = null)
    {
        $this->setMessage('success', $message);
    }

    public function error($message = null)
    {
        $this->setMessage('danger', $message);
    }

    private function setMessage($type = 'success', $message = null)
    {
        session()->flash('messageType', $type);
        session()->flash('message', $message ? $message : $this->messages[$type]);
    }

    public function shouldBeConfirmed()
    {
        if (method_exists($this, 'getConfirmationMessage')) {
            return !empty($this->getConfirmationMessage(null));
        }

        return false;
    }
}
