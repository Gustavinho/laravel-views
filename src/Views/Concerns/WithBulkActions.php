<?php

namespace LaravelViews\Views\Concerns;

trait WithBulkActions
{
    use WithActions;

    /** @var Array Defined bulk actions */
    public $bulkActions = [];

    public $selected = [];

    public $allSelected = false;

    public function initializeWithBulkActions()
    {
        if (method_exists($this, 'bulkActions')) {
            $this->bulkActions = $this->bulkActions();
        }
    }

    public function updatedAllSelected($value)
    {
        $this->selected = $value ? $this->items->keys() : [];
    }

    /**
     * @param string $alias Action's name
     * @param string $id Model's id
     */
    public function executeBulkAction($alias, ...$args)
    {
        $args = array_merge([$this->selected], $args);

        $this->executeAction($alias, ...$args);
    }

    /**
     * Finds an action by its alias
     * @param string $alias 
     * @return \LaravelViews\Actions\Action 
     */
    protected function findAction(string $alias)
    {
        return collect($this->actions)->merge($this->bulkActions)->first(
            function ($actionToFind) use ($alias) {
                return $actionToFind->alias() === $alias;
            }
        );
    }
}
