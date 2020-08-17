<?php

namespace LaravelViews\Test\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Database\FoodTest;
use LaravelViews\Test\Database\ReviewTest;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockReviewTableView;
use LaravelViews\Test\Mock\MockReviewTableViewWithSearch;
use LaravelViews\Test\TestCase;
use Livewire\Livewire;

class RelationalSearchTest extends TestCase
{
    use RefreshDatabase;

    private $livewire;
    private $users;
    private $reviews;

    protected function setUp(): void
    {
        parent::setUp();

        factory(FoodTest::class, 10)->create();
        $this->users = factory(UserTest::class, 10)
            ->create()
            ->each(function (UserTest $user) {
                $user->reviews()->saveMany(factory(ReviewTest::class)->make());
            });

        $this->reviews = ReviewTest::all();

        $this->livewire = Livewire::test(MockReviewTableView::class);
    }


    public function testSeeAllDataFoundBySearchInput()
    {
        $user = $this->reviews->last()->user;

        $this->livewire = Livewire::test(MockReviewTableViewWithSearch::class);

        $this->livewire->set('search', $user->email);

        $userReviews = $user->reviews;

        $otherUserReviews = ReviewTest::where('user_id', '!=', $user->id)->get();

        // Filtered user
        $this->assertSeeReviews($this->livewire, $userReviews)
            // Rest of the users
            ->assertDontSeeReviews($this->livewire, $otherUserReviews);
    }


    private function assertSeeReviews($livewire, $reviews, $assert = 'assertSee')
    {
        foreach ($reviews as $review) {
            $livewire
                ->$assert($review->user->email);
        }

        if ($assert === 'assertSee') {
            $livewire->assertSee("{$reviews->count()} items");
        }

        return $this;
    }

    private function assertDontSeeReviews($livewire, $reviews)
    {
        return $this->assertSeeReviews($livewire, $reviews, 'assertDontsee');
    }
}
