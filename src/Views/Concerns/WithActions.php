<?php

namespace LaravelViews\Views\Concerns;

use Exception;
use Illuminate\Support\Str;
use LaravelViews\Actions\Action;
use LaravelViews\Exceptions\ConfirmActionException;
use Livewire\ImplicitlyBoundMethod;

trait WithActions
{
    /** @var Array Defined actions */
    public $actions = [];

    protected $confirmCurrentAction = true;

    public function initializeWithActions()
    {
        if (method_exists($this, 'actions')) {
            $this->actions = $this->actions();
        }
    }

    /**
     * @param string $alias Action's name
     */
    public function executeAction($alias, ...$args)
    {
        /** @var Action  */
        $action = $this->findAction($alias);

        if (!$action) throw new Exception("Unable to find the {$alias} action");

        $this->checkActionConfirmation($args);

        try {
            $args = $this->handleActionExecuting($action, $args);

            $this->confirmCurrentAction = true;
        } catch (ConfirmActionException $e) {
            if ($this->confirmCurrentAction) {
                $this->emitSelf('openConfirmationModal', [
                    'message' => $e->getMessage(),
                    'alias' => $action->alias(),
                    'args' => $args,
                ]);
            }

            return;
        }

        $params = array_merge($args, ['component' => $this]);

        $result = ImplicitlyBoundMethod::call(app(), [$action, 'handle'], $params);

        $this->handleActionExecuted($action, $result, $args);

        return $result;
    }

    /**
     * Finds an action by its alias
     * @param string $alias 
     * @return \LaravelViews\Actions\Action 
     */
    protected function findAction(string $alias)
    {
        return collect($this->actions)->first(
            function ($actionToFind) use ($alias) {
                return $actionToFind->alias() === $alias;
            }
        );
    }

    protected function checkActionConfirmation(&$args)
    {
        $this->confirmCurrentAction = !in_array('actionConfirmed', $args);

        if (false !== ($key = array_search('actionConfirmed', $args))) {
            unset($args[$key]);
        }
    }

    protected function handleActionExecuting($action, $args)
    {
        $params = array_merge($args, ['action' => $action, 'args' => $args]);

        if (method_exists($this, 'executing')) {
            $args = ImplicitlyBoundMethod::call(app(), [$this, 'executing'], $params) ?? $args;
        }

        if (method_exists($this, $executing = Str::camel('executing_' . $action->alias()))) {
            $args = ImplicitlyBoundMethod::call(app(), [$this, $executing], $params) ?? $args;
        }

        return $args;
    }

    protected function handleActionExecuted($action, $result, $args)
    {
        $params = array_merge($args, ['result' => $result, 'action' => $action, 'args' => $args]);

        if (method_exists($this, 'executed')) {
            ImplicitlyBoundMethod::call(
                app(),
                [$this, 'executed'],
                $params
            );
        }

        if (method_exists($this, $executed = Str::camel('executed_' . $action->alias()))) {
            ImplicitlyBoundMethod::call(
                app(),
                [$this, $executed],
                $params
            );
        }
    }

    protected function confirmAction($message = '')
    {
        if ($this->confirmCurrentAction)
            throw new ConfirmActionException($message);
    }

    public function shouldRenderAction($action, ...$params)
    {
        if (method_exists($this, $render = Str::camel('render_' . $action->alias()))) {
            return ImplicitlyBoundMethod::call(
                app(),
                [$this, $render],
                $params
            );
        }

        return true;
    }
}
