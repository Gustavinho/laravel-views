<?php

namespace LaravelViews\Views\Traits;

trait WithAlerts
{
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
        $view = $this->view ? $this->view : $view;

        $messages = [
            'success' => __('Action was executed successfully'),
            'danger' => __('There was an error executing this action'),
        ];

        $view->emitSelf('notify', [
            'message' => $message ? $message : $messages[$type],
            'type' => $type
        ]);
    }

}