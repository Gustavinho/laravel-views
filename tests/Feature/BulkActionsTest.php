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
        $input = '<input type="checkbox" class="w-4 h-4 rounded" value="'.$user->getKey().'" wire:model="selected">';

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

    public function testSelectUnselectAll()
    {
        $users = factory(UserTest::class, 7)->create();

        Livewire::test(MockTableViewWithBulkActions::class)
            ->set('allSelected', true)
            ->assertSet('selected', $users->pluck('id')->toArray())
            ->set('allSelected', false)
            ->assertSet('selected', []);
    }

    public function testExecuteActionToSelectedRows()
    {
        $users = factory(UserTest::class, 7)->create();

        Livewire::test(MockTableViewWithBulkActions::class)
            ->set('allSelected', true)
            ->call('executeBulkAction', 'test-delete-users-action', true)
            ->assertEmitted('notify', [
                'message' => 'Action was executed successfully',
                'type' => 'success'
            ])->assertDontSeeUsers($users);

        foreach ($users as $user) {
            $this->assertDatabaseMissing('users', $user->toArray());
        }
    }

    public function testExecuteBulkActionsWithConfirmationMessage()
    {
        $users = factory(UserTest::class, 7)->create();

        Livewire::test(MockTableViewWithBulkActions::class)
            ->set('allSelected', true)
            ->call('executeBulkAction', 'test-confirmed-delete-users-action')
            ->assertEmitted('openConfirmationModal', [
                'message' => 'Do you really want to perform this action?',
                'id' => 'test-confirmed-delete-users-action',
            ])

            // Second time with false to avoid validating if the action needs to be confirmed
            ->call('confirmAndExecuteBulkAction', 'test-confirmed-delete-users-action')
            ->assertEmitted('notify', [
                'message' => 'Action was executed successfully',
                'type' => 'success'
            ])
            ->assertDontSeeUsers($users);

        foreach ($users as $user) {
            $this->assertDatabaseMissing('users', $user->toArray());
        }
    }
}
