<?php

namespace LaravelViews\Test\Mock;

use LaravelViews\Actions\Action;
use LaravelViews\Filters\Filter;

class TestSuccessAction extends Action
{
    public function handle($model)
    {
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

class MockTableViewWithActions extends MockTableView
{
    protected function actionsByRow()
    {
        return [
            new TestSuccessAction,
            new TestErrorAction,
        ];
    }
}
