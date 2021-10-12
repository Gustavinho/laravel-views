<?php

namespace LaravelViews\Views\Traits;

use Exception;
use LaravelViews\Actions\Action;

trait WithActions
{
    private $shouldVerifyConfirmation = true;

    /** @var Array Defined bulk actions */
    public $bulkActions = [];

    /** @var Array Defined bulk actions */
    public $actions = [];

    public $selected = [];

    public $allSelected = false;

    public function updatedAllSelected($value)
    {
        $this->selected = $value ? $this->query->pluck('id')->map(function ($id) {
            return (string)$id;
        })->toArray() : [];
    }

    public function mountWithActions()
    {
        if (method_exists($this, 'bulkActions')) {
            $this->bulkActions = $this->bulkActions();
        }

        if (method_exists($this, 'actions')) {
            $this->actions = $this->actions();
        }
    }

    public function hydrateWithActions()
    {
        if (method_exists($this, 'bulkActions')) {
            $this->bulkActions = $this->bulkActions();
        }

        if (method_exists($this, 'actions')) {
            $this->actions = $this->actions();
        }
    }

    /**
     * @param string $action Action's name
     * @param string $id Model's id
     */
    public function executeAction($actionId, $actionableItemId)
    {
        $this->shouldVerifyConfirmation = true;
        $this->executeActionHandler($actionId, $actionableItemId);
    }

    public function confirmAndExecuteAction($actionId, $actionableItemId)
    {
        $this->shouldVerifyConfirmation = false;
        $this->executeActionHandler($actionId, $actionableItemId);
    }

    public function executeBulkAction($action)
    {
        $this->shouldVerifyConfirmation = true;
        $this->executeActionHandler($action);
    }

    public function confirmAndExecuteBulkAction($action)
    {
        $this->shouldVerifyConfirmation = false;
        $this->executeActionHandler($action);
    }

    private function executeActionHandler($actionId, $actionableItemId = null)
    {
        /** @var Action  */
        $action = $this->findAction($actionId);

        if ($action) {
            // If the action needs confirmation
            if ($this->shouldVerifyConfirmation && $action->shouldBeConfirmed()) {
                $this->confirmAction($action, $actionableItemId);
            } else {
                // If $actionableItemId is null then it is a bulk action
                // and it uses the current selection
                $actionableItems = $actionableItemId ? $this->getItemThatFiredAction($actionableItemId) : $this->selected;
                $action->handle($actionableItems, $this);
            }
        } else {
            throw new Exception("Unable to find the {$actionId} action");
        }
    }

    /**
     * Opens confirmation modal for a specific action
     * @param Action $action
     */
    private function confirmAction($action, $modelId = null)
    {
        $actionData = [
            'message' => $action->confirmationMessage($modelId ? $this->getItemThatFiredAction($modelId) : null),
            'id' => $action->id()
        ];

        if ($modelId) {
            $actionData['modelId'] = $modelId;
        }
        $this->emitSelf('openConfirmationModal', $actionData);
    }

    /**
     * Finds an action by its id
     */
    private function findAction(string $actionId)
    {
        $action = clone collect($this->actions)->merge($this->bulkActions)->first(
            function ($actionToFind) use ($actionId) {
                return $actionToFind->id() === $actionId;
            }
        );

        $action->component = $this;

        return $action;
    }
}
