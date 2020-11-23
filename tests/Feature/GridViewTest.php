<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Database\FoodTest;
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
        $foods = factory(FoodTest::class, 10)->create();

        $livewire = Livewire::test(MockGridView::class);

        foreach ($foods as $food) {
            $livewire->assertSee($food->name)
                ->assertSee($food->description);
        }
    }
}
