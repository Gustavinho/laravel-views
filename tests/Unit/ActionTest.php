<?php

namespace LaravelViews\Test\Unit;

use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Test\TestCase;

class ActionTest extends TestCase
{
    public function testShouldBeConfirmed()
    {
        $action = new class extends Action {
            public function handle($item) {}
        };

        $this->assertFalse($action->shouldBeConfirmed());

        $actionWithConfirmation = new class extends Action {
            use Confirmable;

            public function handle($item) {}
        };

        $this->assertTrue($actionWithConfirmation->shouldBeConfirmed());
    }
}
