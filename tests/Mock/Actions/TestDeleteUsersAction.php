<?php

namespace LaravelViews\Test\Mock\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Views\View;

class TestDeleteUsersAction extends Action
{
    public function handle($models, View $view)
    {
        UserTest::whereKey($models)->delete();
        $this->success();
    }
}
