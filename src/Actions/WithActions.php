<?php

namespace LaravelViews\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Actions\ExecuteAction;

trait WithActions
{
    public $confirmationMessage = null;

    /** @var Action $actionToBeConfirmed sets a temporal action to be executed once it will be confirmed */
    public $actionToBeConfirmed = null;

    /**
     * @param string $action Action's name
     * @param string $id Model's id
     * @param boolean $shouldVerifyConfirmation
     */
    public function executeAction($action, $id, $shouldVerifyConfirmation, ExecuteAction $executeAction)
    {
        $item = $this->getModelWhoFiredAction($id);

        /** @var {ExecuteAction} Executes the action, if it needs to be confirmed it will return the action to be confirmed  */
        $actionToBeConfirmed = $executeAction
            ->setView($this)
            ->shouldVerifyConfirmation($shouldVerifyConfirmation)
            ->callByActionName($action, $item, $this->actions);

        /** If the action need to be confirmed */
        if ($actionToBeConfirmed) {
            $this->fill([
                /** Stores action id and item id to be executed before, this is needed on the confirmation message component */
                'actionToBeConfirmed' => [$actionToBeConfirmed->id, $item->id,],
                'confirmationMessage' => $actionToBeConfirmed->getConfirmationMessage($item)
            ]);
        } else {
            $this->closeConfirmationMessage();
        }
    }

    public function executeBulkAction($action, ExecuteAction $executeAction)
    {
        $actionableItems = $this->selected;
        $executeAction->setView($this)
            ->callByActionName($action, $actionableItems, $this->bulkActions);
    }

    public function closeConfirmationMessage()
    {
        $this->confirmationMessage = null;
        $this->actionToBeConfirmed = null;
    }

    public function getActionsProperty()
    {
        return $this->getActions();
    }

    public function getBulkActionsProperty()
    {
        if (method_exists($this, 'bulkActions')) {
            return $this->bulkActions();
        }

        return [];
    }
}
