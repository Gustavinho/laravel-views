<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockGridView;
use Livewire\Livewire;

class GridViewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testSeeAllGridData()
    {
        $users = factory(UserTest::class, 10)->create();

        $livewire = Livewire::test(MockGridView::class);

        foreach ($users as $user) {
            $livewire->assertSee($user->name)
                ->assertSee($user->email);
        }
    }
}
