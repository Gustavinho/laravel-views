<?php

namespace LaravelViews\Test\Mock;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Test\Database\ReviewTest;
use LaravelViews\Views\TableView;

class MockReviewTableViewWithSearch extends TableView
{
    public $searchBy = [ 'user.email'];

    public function repository(): Builder
    {
        return ReviewTest::query();
    }

    public function headers()
    {
        return [
            'Id',
            'Author Email',
        ];
    }

    public function row(ReviewTest $review)
    {
        return [
            $review->id,
            $review->user->email,
        ];
    }
}
