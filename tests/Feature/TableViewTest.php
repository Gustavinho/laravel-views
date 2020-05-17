<?php

namespace Gustavinho\LaravelViews\Test\Feature;

use Gustavinho\LaravelViews\Test\Database\UserTest;
use Gustavinho\LaravelViews\Test\Mock\MockTableView;
use Gustavinho\LaravelViews\Test\Mock\MockTableViewWithSearchAndFilters;
use Gustavinho\LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class TableViewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->livewire = Livewire::test(MockTableView::class);
    }

    public function testSeeAllHeaders()
    {
        factory(UserTest::class, 10)->create();
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
            ->assertDontSee('Fiters');
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

    // TODO: Test flush message

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

    private function assertSeeUsers($livewire, $users, $assert = 'assertSee')
    {
        foreach ($users as $user) {
            $livewire->$assert(htmlspecialchars_decode($user->name))
                ->$assert($user->email);
        }

        if ($assert == 'assertSee') {
            $livewire->assertSee("{$users->count()} items");
        }

        return $this;
    }

    private function assertDontSeeUsers($livewire, $users)
    {
        return $this->assertSeeUsers($livewire, $users, 'assertDontsee');
    }
}
