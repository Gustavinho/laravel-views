<?php

namespace LaravelViews\Test\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Mock\MockTableViewWithActions;
use LaravelViews\Test\TestCase;
use Livewire\Livewire;

class ExecuteActionsTest extends TestCase
{
    use RefreshDatabase;

    public function testSeeSuccessAlert()
    {
        Livewire::test(MockTableViewWithActions::class)
            ->call('executeAction', 'test-success-action', 1, true)
            ->assertEmitted('test-event');
    }
}
