<?php

namespace LaravelViews\Test\Unit;

use LaravelViews\Actions\RedirectAction;
use LaravelViews\Test\TestCase;

class RedirectActionTest extends TestCase
{
    public function testGenerateDynamicIdByRouteName()
    {
        $redirectAction = new RedirectAction('user', 'See user', 'eye');

        $this->assertEquals($redirectAction->id, 'redirect-action-user');
    }
}
