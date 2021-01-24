<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockListView;
use Livewire\Livewire;

class ListViewTest extends TestCase
{
    use RefreshDatabase;

    public function testSeeAllListItemsData()
    {
        $users = factory(UserTest::class, 10)->create();
        $livewire = Livewire::test(MockListView::class);

        foreach ($users as $user) {
            $livewire->assertSee($user->name)
                ->assertSee($user->email)
                ->assertSeeHtml(htmlentities($user->avatar));
        }
    }
}
