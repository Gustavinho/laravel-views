<?php

namespace LaravelViews\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class ExecuteAction
{
    private $shouldVerifyConfirmation = null;
    private $view;

    public function setView(View $view)
    {
        $this->view = $view;
        return $this;
    }

    public function shouldVerifyConfirmation($value)
    {
        $this->shouldVerifyConfirmation = $value;
        return $this;
    }

    public function callByActionName(string $actionId, $item, $actions = [])
    {
        /** @var Action */
        $action = $this->findAction($actionId, $actions);
        $action->view = $this->view;

        if ($action) {
            if ($this->shouldVerifyConfirmation && $action->shouldBeConfirmed()) {
                return $action;
            } else {
                $action->handle($item, $this->view);
            }
        }

        return null;
    }

    private function findAction(string $actionId, $actions)
    {
        return collect($actions)->first(
            function ($actionToFind) use ($actionId) {
                return $actionToFind->id === $actionId;
            }
        );
    }
}
