<?php

namespace LaravelViews\Test\Mock;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Views\ListView;

class MockListView extends ListView
{
    public function repository(): Builder
    {
        return UserTest::query();
    }

    public function data(UserTest $user)
    {
        return [
            'avatar' => $user->avatar,
            'title' => $user->name,
            'subtitle' => $user->email,
        ];
    }
}
