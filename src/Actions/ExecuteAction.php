<?php

namespace LaravelViews\Actions;

use LaravelViews\Actions\Action;

class ExecuteAction
{
    private $shouldVerifyConfirmation = null;

    public function shouldVerifyConfirmation($value)
    {
        $this->shouldVerifyConfirmation = $value;

        return $this;
    }

    public function callByActionName(string $actionId, $item, $actions = [])
    {
        /** @var Action */
        $action = $this->findAction($actionId, $actions);
        if ($action) {
            if ($this->shouldVerifyConfirmation && $action->shouldBeConfirmed()) {
                return $action;
            } else {
                $action->handle($item);
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
