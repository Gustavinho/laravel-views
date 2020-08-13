<?php

namespace LaravelViews\Test\Mock;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Test\Database\ReviewTest;
use LaravelViews\Views\TableView;

class MockReviewTableView extends TableView
{
    // public $searchBy = ['id'];

    public function repository(): Builder
    {
        return ReviewTest::query();
    }

    public function headers()
    {
        return [
            'Id',
            'Author Email',
            'Food'
        ];
    }

    public function row(ReviewTest $review)
    {
        return [
            $review->id,
            $review->user->email,
            $review->food->name,
        ];
    }
}
