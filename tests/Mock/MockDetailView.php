<?php

namespace LaravelViews\Test\Mock;

use LaravelViews\Facades\UI;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Views\DetailView;

class MockDetailView extends DetailView
{
    protected $modelClass = UserTest::class;

    public function detail(UserTest $model)
    {
        return [
            'Name' => $model->name,
            'Email' => $model->email,
            'Avatar' => $model->avatar,
        ];
    }
}
