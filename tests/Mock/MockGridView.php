<?php

namespace LaravelViews\Test\Mock;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Test\Database\FoodTest;
use LaravelViews\Views\GridView;

class MockGridView extends GridView
{
    // public $searchBy = ['email'];

    public function repository(): Builder
    {
        return FoodTest::query();
    }

    public function cell(FoodTest $food)
    {
        return [
            'photo' => $food->photo,
            'title' => $food->name,
            'description' => $food->description
        ];
    }
}
