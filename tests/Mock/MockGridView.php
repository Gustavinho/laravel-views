<?php

namespace LaravelViews\Test\Mock;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Views\GridView;

class MockGridView extends GridView
{
    // public $searchBy = ['email'];

    public function repository(): Builder
    {
        return UserTest::query();
    }

    public function card(UserTest $user)
    {
        return [
            'image' => '',
            'title' => $user->name,
            'subtitle' => $user->email,
            'description' => $user->email
        ];
    }
}
