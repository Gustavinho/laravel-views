<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockTableView;
use LaravelViews\Test\Mock\MockTableViewWithSearchAndFilters;
use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class SearchDataTest extends TestCase
{
    use RefreshDatabase;

    public function testDontSeeSearchInputIf()
    {
        Livewire::test(MockTableView::class)
            ->assertDontSee('Search');
    }

    public function testSeeAllDataFoundBySearchInput()
    {
        $users = factory(UserTest::class, 10)->create();
        $user = $users->last();

        Livewire::test(MockTableViewWithSearchAndFilters::class)
            ->set('search', $user->email)
            // Filtered user
            ->assertSeeUsers(collect([$user]))
            // Rest of the users
            ->assertDontSeeUsers($users->splice(0, 9));
    }

    public function testClearSearch()
    {
        Livewire::test(MockTableViewWithSearchAndFilters::class)
            ->set('search', 'my-custom-search')
            ->call('clearSearch')
            ->assertSet('search', '');
    }
}
