<?php

namespace LaravelViews\Test\Mock;

use LaravelViews\Test\Database\UserTest;
use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;

class MockTableView extends TableView
{
    // public $searchBy = ['email'];
    protected $model = UserTest::class;

    public function headers()
    {
        return [
            'name',
            'email'
        ];
    }

    public function row(UserTest $user)
    {
        return [
            $user->name,
            $user->email
        ];
    }
}
