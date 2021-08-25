<?php

namespace LaravelViews\Actions;

use Artificertech\LaravelRenderable\Renderable;
use Illuminate\Contracts\View\View as ViewContract;
use LaravelViews\Views\View;
use Illuminate\Support\Str;
use LaravelViews\Views\Traits\WithDynamicComponents;

abstract class Action implements Renderable
{
    use WithDynamicComponents;

    /** @var String $title Title of the action */
    public $title;

    /** @var String $icon Feather icon name*/
    public $icon;

    /** Item the action will be executed with */
    public $item;

    /**
     * Current view that executed the action
     * @var \Livewire\Component $component
     */
    public $component;

    public function isRedirect()
    {
        return get_class($this) === RedirectAction::class;
    }

    public function id()
    {
        return Str::camelToDash((new \ReflectionClass($this))->getShortName());
    }

    public function renderIf($item, \Livewire\Component $component)
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

        $this->component->emitSelf('notify', [
            'message' => $message ? $message : $messages[$type],
            'type' => $type
        ]);
    }

    public function shouldBeConfirmed()
    {
        return method_exists($this, 'confirmationMessage');
    }

    protected function componentParent()
    {
        return $this->component;
    }

    public function variableName(): string
    {
        return 'action';
    }

    public function render(): ViewContract
    {
        return view('laravel-views::actions.action');
    }
}
