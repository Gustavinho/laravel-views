<?php

namespace LaravelViews\Test\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\Actions\TestConfirmedAction;
use LaravelViews\Test\Mock\Actions\TestSuccessAction;
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
            ->assertShowSuccessAlert();
    }

    public function testSeeErrorAlert()
    {
        factory(UserTest::class)->create();

        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-error-action', 1, true)
            ->assertShowErrorAlert();
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
            ->executeAction(TestConfirmedAction::class, $user)
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
            ->executeAction(TestConfirmedAction::class, $user)
            ->assertEmitted('openConfirmationModal', [
                'message' => 'Do you really want to perform this action?',
                'id' => 'test-confirmed-action',
                'modelId' => $user->id
            ])
            ->confirmAction(TestConfirmedAction::class, $user)
            ->assertShowSuccessAlert();
    }

    public function testEmitedEventFromAction()
    {
        Livewire::test(MockTableViewWithActions::class)
            ->executeAction(TestSuccessAction::class, 1)
            ->assertEmitted('test-event');
    }
}
