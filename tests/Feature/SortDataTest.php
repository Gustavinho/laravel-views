<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockTableView;
use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Mock\MockTableViewWithDefaultFilterValue;
use Livewire\Livewire;

class SortDataTest extends TestCase
{
    use RefreshDatabase;

    public function testSeeUsersBySortedColumn()
    {
        $firstUsers = factory(UserTest::class, 20)->create();
        $lastUsers = factory(UserTest::class, 20)->create();

        // first clic to the sortable header
        LiveWire::test(MockTableView::class)
            ->call('sort', 'id')
            ->assertSeeUsers($firstUsers)
            ->assertDontSeeUsers($lastUsers)

            // second clic to the sortable header
            ->call('sort', 'id')
            ->assertSeeUsers($lastUsers)
            ->assertDontSeeUsers($firstUsers);
    }

    public function testSeeAllDataFoundByAFilterWithADefaultValue()
    {
        $activeUsers = factory(UserTest::class, 5)->create(['active' => true]);
        $inactiveUsers = factory(UserTest::class, 5)->create(['active' => false]);

        Livewire::test(MockTableViewWithDefaultFilterValue::class)
            ->assertSeeUsers($activeUsers)
            ->assertDontSeeUsers($inactiveUsers);
    }
}
