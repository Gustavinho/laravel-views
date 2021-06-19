<?php

namespace LaravelViews\Actions;

use LaravelViews\Views\View;
use Illuminate\Support\Str;

abstract class Action
{
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
        $messages = [
            'success' => __('Action was executed successfully'),
            'danger' => __('There was an error executing this action'),
        ];

        $this->view->emitSelf('notify', [
            'message' => $message ? $message : $messages[$type],
            'type' => $type
        ]);
    }

    public function shouldBeConfirmed()
    {
        if (method_exists($this, 'getConfirmationMessage')) {
            return !empty($this->getConfirmationMessage(null));
        }

        return false;
    }
}
