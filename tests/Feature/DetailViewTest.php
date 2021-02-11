<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockDetailView;
use LaravelViews\Test\Mock\MockDetailViewWithActions;
use LaravelViews\Test\Mock\MockDetailViewWithComponents;
use LaravelViews\Test\Mock\MockDetailViewWithMultipleComponents;
use LaravelViews\Test\Traits\WithActions;
use Livewire\Livewire;

class DetailViewTest extends TestCase
{
    use RefreshDatabase, WithActions;

    public function getViewWithActions()
    {
        $user = factory(UserTest::class)->create();
        return Livewire::test(MockDetailViewWithActions::class, ['model' => $user]);
    }

    public function testCreateViewUsingId()
    {
        $user = factory(UserTest::class)->create();

        Livewire::test(MockDetailView::class, ['model' => $user->id])
            ->assertSee($user->name);
    }

    public function testSeeAllDataWithAFieldListAsDefault()
    {
        $user = factory(UserTest::class)->create();

        Livewire::test(MockDetailView::class, ['model' => $user])
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSeeHtml(htmlentities($user->avatar))
            ->assertSee('Name')
            ->assertSee('Email')
            ->assertSee('Avatar');
    }

    public function testSeeAllDatawithACustomComponent()
    {
        $user = factory(UserTest::class)->create();

        Livewire::test(MockDetailViewWithComponents::class, ['model' => $user])
            ->assertSeeHtml($user->name);
    }

    public function testSeeAllDataUsingMultipleComponents()
    {
        $user = factory(UserTest::class)->create();

        Livewire::test(MockDetailViewWithMultipleComponents::class, ['model' => $user])
            ->assertSeeHtml($user->email)
            ->assertSeeHtml($user->name);
    }
}
