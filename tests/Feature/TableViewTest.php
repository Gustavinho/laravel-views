<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockTableView;
use LaravelViews\Test\Mock\MockTableViewWithActions;
use LaravelViews\Test\Mock\MockTableViewWithSearchAndFilters;
use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Mock\MockTableViewWithRedirectActions;
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

    public function testSeeSuccessAlert()
    {
        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-success-action', 1)
            ->assertSee('Action was executed successfully')
            ->assertSee('Success');
    }

    public function testSeeErrorAlert()
    {
        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-error-action', 1)
            ->assertSee('There was an error executing this action')
            ->assertSee('Error!');
    }

    public function testClearAlert()
    {
        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-success-action', 1)
            ->assertSee('Action was executed successfully')
            ->call('flushMessage')
            ->assertDontSee('Action was executed successfully');
    }

    public function testSeeMultipleRedirectActions()
    {
        $icons = ['eye', 'pencil'];
        $class = 'mr-2 text-gray-400 hover:text-blue-600 transition-all duration-300 ease-in-out focus:text-blue-600 active:text-blue-600';

        factory(UserTest::class)->create();

        $table = Livewire::test(MockTableViewWithRedirectActions::class);

        foreach ($icons as $icon) {
            $table->assertSeeHtml('<i data-feather="' . $icon . '" class="' . $class . '"></i>');
        }
    }

    public function testSeeConfirmationMessage()
    {
        $message = 'This is the confirmation message';
        $livewire = Livewire::test(MockTableView::class);
        $livewire->set('confirmationMessage', $message)
            ->assertSee($message);
    }

    public function testCallActionAfterConfirmationMessage()
    {
        $user = factory(UserTest::class)->create();
        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-confirmed-action', $user->id, true)
            ->assertSee('Do you really want to perform this action?')
            ->call('executeAction', 'test-confirmed-action', $user->id, false)
            ->assertSee('Action was executed successfully');
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
