<?php

namespace LaravelViews\Test\Mock\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class TestSuccessAction extends Action
{
    public function handle($model, View $view)
    {
        $view->dispatch('test-event');
        $this->success();
    }
}
