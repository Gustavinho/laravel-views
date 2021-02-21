<?php

namespace LaravelViews\Test\Mock;

use LaravelViews\Facades\UI;
use LaravelViews\Test\Database\UserTest;

class MockDetailViewWithMultipleComponents extends MockDetailView
{
    public function detail(UserTest $model)
    {
        return [
            UI::attributes([
                'Name' => $model->name
            ]),
            UI::attributes([
                'Email' => $model->email
            ]),
        ];
    }
}
