<?php

namespace LaravelViews\Test\Mock;

use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Filters\Filter;
use LaravelViews\Views\View;

class TestSuccessAction extends Action
{
    public function handle($model, View $view)
    {
        $view->emit('test-event');
        $this->success();
    }
}

class TestErrorAction extends Action
{
    public function handle($model)
    {
        $this->error();
    }
}

class TestConfirmedAction extends Action
{
    use Confirmable;

    public function handle($model) {
        $this->success();
    }
}

class MockTableViewWithActions extends MockTableView
{
    protected function actionsByRow()
    {
        return [
            new TestSuccessAction,
            new TestErrorAction,
            new TestConfirmedAction
        ];
    }
}
