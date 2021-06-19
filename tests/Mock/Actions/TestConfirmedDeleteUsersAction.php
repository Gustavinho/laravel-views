<?php

namespace LaravelViews\Test\Mock\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Views\View;

class TestConfirmedDeleteUsersAction extends Action
{
    use Confirmable;

    public function handle($models, View $view)
    {
        UserTest::whereKey($models)->delete();
        $this->success();
    }
}
