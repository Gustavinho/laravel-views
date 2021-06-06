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

    /**
     * Finds an action inside an array by its name and executes it
     * @param {String} $actionId Action's name, this is the unique identifier of the action
     * @param {Model|Array} $actionableItems Model instance or array of the model id's to execute the actions
     * @param {Array} $actions Array of the actions defined in the view
     */
    public function callByActionName(string $actionId, $actionableItems, $actions = [])
    {
        /** @var Action */
        $action = $this->findAction($actionId, $actions);
        if ($action) {
            $action->view = $this->view;
            if ($this->shouldVerifyConfirmation && $action->shouldBeConfirmed()) {
                return $action;
            } else {
                $action->handle($actionableItems, $this->view);
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
