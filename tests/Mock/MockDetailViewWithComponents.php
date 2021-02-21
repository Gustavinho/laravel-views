<?php

namespace LaravelViews\Test\Mock;

use LaravelViews\Facades\UI;
use LaravelViews\Test\Database\UserTest;

class MockDetailViewWithComponents extends MockDetailView
{
    public function detail(UserTest $model)
    {
        return UI::attributes([
            'Name' => $model->name
        ]);
    }
}
