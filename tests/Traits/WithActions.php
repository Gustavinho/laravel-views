<?php

namespace LaravelViews\Test\Traits;

use LaravelViews\Test\Database\UserTest;

trait WithActions
{
    public function testSeeSuccessAlert()
    {
        $this->getViewWithActions()
            ->call('executeAction', 'test-success-action', 1, true)
            ->assertSee('Action was executed successfully')
            ->assertSee('Success');
    }

    public function testSeeErrorAlert()
    {
        $this->getViewWithActions()
            ->call('executeAction', 'test-error-action', 1, true)
            ->assertSee('There was an error executing this action')
            ->assertSee('Error!');
    }

    public function testClearAlert()
    {
        $this->getViewWithActions()
            ->call('executeAction', 'test-success-action', 1, true)
            ->assertSee('Action was executed successfully')
            ->call('flushMessage')
            ->assertDontSee('Action was executed successfully');
    }

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
            ->assertSee('Action was executed successfully');
    }
}
