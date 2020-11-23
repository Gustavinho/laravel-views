<?php

namespace LaravelViews\Test\Unit;

use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class ActionTest extends FrameworkTestCase
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
