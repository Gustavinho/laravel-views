<?php

namespace LaravelViews\Test\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\Actions\TestConfirmedDeleteUsersAction;
use LaravelViews\Test\Mock\Actions\TestDeleteUsersAction;
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
            ->selectAll()
            ->assertSet('selected', $users->pluck('id')->toArray())
            ->set('allSelected', false)
            ->assertSet('selected', []);
    }

    public function testExecuteActionToSelectedRows()
    {
        $users = factory(UserTest::class, 7)->create();

        Livewire::test(MockTableViewWithBulkActions::class)
            ->selectAll()
            ->executeBulkAction(TestDeleteUsersAction::class)
            ->assertShowSuccessAlert()
            ->assertDontSeeUsers($users);

        foreach ($users as $user) {
            $this->assertDatabaseMissing('users', $user->toArray());
        }
    }

    public function testExecuteBulkActionsWithConfirmationMessage()
    {
        $users = factory(UserTest::class, 7)->create();

        Livewire::test(MockTableViewWithBulkActions::class)
            ->selectAll()
            ->executeBulkAction(TestConfirmedDeleteUsersAction::class)
            ->assertEmitted('openConfirmationModal', [
                'message' => 'Do you really want to perform this action?',
                'id' => 'test-confirmed-delete-users-action',
            ])
            ->confirmAction(TestConfirmedDeleteUsersAction::class)
            ->assertShowSuccessAlert()
            ->assertDontSeeUsers($users);

        foreach ($users as $user) {
            $this->assertDatabaseMissing('users', $user->toArray());
        }
    }
}
