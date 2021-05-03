<?php

namespace LaravelViews\Test\Traits;

use LaravelViews\Test\Database\UserTest;

trait WithActions
{
    public function testSeeSuccessAlert()
    {
        $this->getViewWithActions()
            ->call('executeAction', 'test-success-action', 1, true)
            ->assertEmitted('notify', [
                'message' => 'Action was executed successfully',
                'type' => 'success'
            ]);
    }

    public function testSeeErrorAlert()
    {
        $this->getViewWithActions()
            ->call('executeAction', 'test-error-action', 1, true)
            ->assertEmitted('notify', [
                'message' => 'There was an error executing this action',
                'type' => 'danger'
            ]);
    }

    // TODO: Test custom error message

    public function testSeeMultipleRedirectActions()
    {
        $icons = ['eye', 'pencil'];

        $view = $this->getViewWithActions();

        foreach ($icons as $icon) {
            $view->assertSeeHtml('data-feather="' . $icon . '"');
        }
    }

    public function testSeeConfirmationMessage()
    {
        $message = 'This is the confirmation message';

        $this->getViewWithActions()
            ->set('confirmationMessage', $message)
            ->assertSee($message);
    }

    public function testCallActionAfterConfirmationMessage()
    {
        $user = factory(UserTest::class)->create();
        $this->getViewWithActions()
            ->call('executeAction', 'test-confirmed-action', $user->id, true)
            ->assertSee('Do you really want to perform this action?')
            ->call('executeAction', 'test-confirmed-action', $user->id, false)
            ->assertEmitted('notify', [
                'message' => 'Action was executed successfully',
                'type' => 'success'
            ]);
    }
}
