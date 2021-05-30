<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockTableView;
use LaravelViews\Test\Mock\MockTableViewWithSearchAndFilters;
use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Mock\MockTableViewWithActions;
use LaravelViews\Test\Mock\MockTableViewWithDefaultFilterValue;
use LaravelViews\Test\Traits\WithActions;
use Livewire\Livewire;

class TableViewTest extends TestCase
{
    use RefreshDatabase, WithActions;

    public function getViewWithActions()
    {
        factory(UserTest::class)->create();
        return Livewire::test(MockTableViewWithActions::class);
    }

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testSeeAllHeaders()
    {
        factory(UserTest::class, 1)->create();
        $livewire = Livewire::test(MockTableView::class);
        $headers = ['name', 'email'];

        foreach ($headers as $header) {
            $livewire->assertSee($header);
        }
    }

    public function testSeeAllDataOnTheTable()
    {
        $users = factory(UserTest::class, 7)->create();
        $livewire = Livewire::test(MockTableView::class);

        $this->assertSeeUsers($livewire, $users);
    }

    public function testDontSeeSearchInputIf()
    {
        Livewire::test(MockTableView::class)
            ->assertDontSee('Search');
    }

    public function testDontSeeFiltersButton()
    {
        Livewire::test(MockTableView::class)
            ->assertDontSee('Filters');
    }

    public function testSeeAllDataFoundBySearchInput()
    {
        $users = factory(UserTest::class, 10)->create();
        $user = $users->last();
        $livewire = Livewire::test(MockTableViewWithSearchAndFilters::class);

        $livewire->set('search', $user->email);

        // Filtered user
        $this->assertSeeUsers($livewire, collect([$user]))
            // Rest of the users
            ->assertDontSeeUsers($livewire, $users->splice(0, 9));
    }

    public function testSeeAllDataFoundByAFilter()
    {
        $activeUsers = factory(UserTest::class, 5)->create(['active' => true]);
        $inactiveUsers = factory(UserTest::class, 5)->create(['active' => false]);
        $livewire = Livewire::test(MockTableViewWithSearchAndFilters::class);

        $livewire->set('filters', [
            'active-users-filter' => 1
        ]);

        $this->assertSeeUsers($livewire, $activeUsers)
            ->assertDontSeeUsers($livewire, $inactiveUsers);
    }

    public function testSeeAllDataFoundByAFilterWithADefaultValue()
    {
        $activeUsers = factory(UserTest::class, 5)->create(['active' => true]);
        $inactiveUsers = factory(UserTest::class, 5)->create(['active' => false]);
        $livewire = Livewire::test(MockTableViewWithDefaultFilterValue::class);

        $this->assertSeeUsers($livewire, $activeUsers)
            ->assertDontSeeUsers($livewire, $inactiveUsers);
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

    public function testClearSearch()
    {
        Livewire::test(MockTableViewWithSearchAndFilters::class)
            ->set('search', 'my-custom-search')
            ->call('clearSearch')
            ->assertSet('search', '');
    }

    public function testSeeUsersBySortedColumn()
    {
        $firstUsers = factory(UserTest::class, 20)->create();
        $lastUsers = factory(UserTest::class, 20)->create();

        // first clic to the sortable header
        $livewire = LiveWire::test(MockTableView::class)
            ->call('sort', 'id');

        $this->assertSeeUsers($livewire, $firstUsers);
        $this->assertDontSeeUsers($livewire, $lastUsers);

        // second clic to the sortable header
        $livewire->call('sort', 'id');

        $this->assertSeeUsers($livewire, $lastUsers);
        $this->assertDontSeeUsers($livewire, $firstUsers);
    }

    private function assertSeeUsers($livewire, $users, $assert = 'assertSee')
    {
        foreach ($users as $user) {
            $livewire->$assert(htmlspecialchars_decode($user->name))
                ->$assert($user->email);
        }

        // TODO: Get a param to disable this
        /* if ($assert == 'assertSee') {
            $livewire->assertSee("{$users->count()} items");
        } */

        return $this;
    }

    private function assertDontSeeUsers($livewire, $users)
    {
        return $this->assertSeeUsers($livewire, $users, 'assertDontsee');
    }
}
