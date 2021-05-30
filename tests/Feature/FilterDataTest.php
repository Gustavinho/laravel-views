<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockTableView;
use LaravelViews\Test\Mock\MockTableViewWithSearchAndFilters;
use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class FilterDataTest extends TestCase
{
    use RefreshDatabase;

    public function testDontSeeFiltersButton()
    {
        Livewire::test(MockTableView::class)
            ->assertDontSee('Filters');
    }

    public function testSeeAllDataFoundByAFilter()
    {
        $activeUsers = factory(UserTest::class, 5)->create(['active' => true]);
        $inactiveUsers = factory(UserTest::class, 5)->create(['active' => false]);

        Livewire::test(MockTableViewWithSearchAndFilters::class)
            ->set('filters', [
                'active-users-filter' => 1
            ])
            ->assertSeeUsers($activeUsers)
            ->assertDontSeeUsers($inactiveUsers);
    }


    public function testClearFilters()
    {
        Livewire::test(MockTableViewWithSearchAndFilters::class)
            ->set('filters', [
                'active-users-filter' => 1
            ])
            ->call('clearFilters')
            ->assertSet('filters', []);
    }
}
