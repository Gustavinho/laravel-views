<?php

namespace LaravelViews\Views;

use LaravelViews\Views\Concerns\WithConfigurableComponents;
use Livewire\Component;

abstract class View extends Component
{
    use WithConfigurableComponents;

    public function success($message = null)
    {
        $this->setMessage('success', $message);
    }

    public function error($message = null)
    {
        $this->setMessage('danger', $message);
    }

    protected function setMessage($type = 'success', $message = null)
    {
        $messages = [
            'success' => __('Action was executed successfully'),
            'danger' => __('There was an error executing this action'),
        ];

        $this->emitSelf('notify', [
            'message' => $message ? $message : $messages[$type],
            'type' => $type
        ]);
    }
}
