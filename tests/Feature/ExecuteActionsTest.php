<?php

namespace LaravelViews\Test\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockTableViewWithActions;
use LaravelViews\Test\TestCase;
use Livewire\Livewire;

class ExecuteActionsTest extends TestCase
{
    use RefreshDatabase;

    public function testSeeSuccessAlert()
    {
        factory(UserTest::class)->create();

        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-success-action', 1, true)
            ->assertEmitted('notify', [
                'message' => 'Action was executed successfully',
                'type' => 'success'
            ]);
    }

    public function testSeeErrorAlert()
    {
        factory(UserTest::class)->create();

        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-error-action', 1, true)
            ->assertEmitted('notify', [
                'message' => 'There was an error executing this action',
                'type' => 'danger'
            ]);
    }

    // TODO: Test custom error message

    public function testSeeMultipleRedirectActions()
    {
        factory(UserTest::class)->create();
        $icons = ['eye', 'pencil'];

        $livewire = Livewire::test(MockTableViewWithActions::class);

        foreach ($icons as $icon) {
            $livewire->assertSeeHtml('data-feather="' . $icon . '"');
        }
    }

    public function testSeeConfirmationMessage()
    {
        $user = factory(UserTest::class)->create();
        $message = 'Do you really want to perform this action?';

        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-confirmed-action', $user->id)
            ->assertEmitted('openConfirmationModal', [
                'message' => $message,
                'id' => 'test-confirmed-action',
                'modelId' => $user->id
            ]);
    }

    // TODO: test custom confirmation message

    public function testCallActionAfterConfirmationMessage()
    {
        $user = factory(UserTest::class)->create();

        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-confirmed-action', $user->id)
            ->assertEmitted('openConfirmationModal', [
                'message' => 'Do you really want to perform this action?',
                'id' => 'test-confirmed-action',
                'modelId' => $user->id
            ])
            ->call('confirmAndExecuteAction', 'test-confirmed-action', $user->id)
            ->assertEmitted('notify', [
                'message' => 'Action was executed successfully',
                'type' => 'success'
            ]);
    }

    public function testEmitedEventFromAction()
    {
        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-success-action', 1, true)
            ->assertEmitted('test-event');
    }
}
