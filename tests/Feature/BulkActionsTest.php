<?php

namespace LaravelViews\Test\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockTableViewWithActions;
use LaravelViews\Test\Mock\MockTableViewWithBulkActions;
use LaravelViews\Test\TestCase;
use Livewire\Livewire;

class BulkActionsTest extends TestCase
{
    use RefreshDatabase;

    public function testSeeCheckBoxesWhenBulkActionsIsDefiend()
    {
        $user = factory(UserTest::class)->create();
        $input = '<input wire:model="selected" type="checkbox" value="'.$user->getKey().'">';

        Livewire::test(MockTableViewWithActions::class)
            ->assertDontSeeHtml($input);

        Livewire::test(MockTableViewWithBulkActions::class)
            ->assertSeeHtml($input);
    }

    public function testSeeActionsButtonWhenThereAreSelectedRows()
    {
        $user = factory(UserTest::class)->create();

        Livewire::test(MockTableViewWithBulkActions::class)
            ->assertDontSee('Actions')
            ->set('selected', [$user->id])
            ->assertSee('Actions');
    }

    public function testExecuteActionToSelectedRows()
    {
        $users = factory(UserTest::class, 7)->create();

        Livewire::test(MockTableViewWithBulkActions::class)
            ->set('selected', $users->pluck('id'))
            ->call('executeBulkAction', 'test-delete-users-action', true)
            ->assertEmitted('notify', [
                'message' => 'Action was executed successfully',
                'type' => 'success'
            ])->assertDontSeeUsers($users);

        foreach ($users as $user) {
            $this->assertDatabaseMissing('users', $user->toArray());
        }
    }

    public function testSelectUnselectAll()
    {
        $users = factory(UserTest::class, 7)->create();

        Livewire::test(MockTableViewWithBulkActions::class)
            ->set('allSelected', true)
            ->assertSet('selected', $users->pluck('id'))
            ->set('allSelected', false)
            ->assertSet('selected', []);
    }
}
