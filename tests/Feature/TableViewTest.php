<?php

namespace LaravelViews\Test\Feature;

use LaravelViews\Test\Database\UserTest;
use LaravelViews\Test\Mock\MockTableView;
use LaravelViews\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelViews\Test\Mock\MockTableViewWithModelClass;
use Livewire\Livewire;

class TableViewTest extends TestCase
{
    use RefreshDatabase;

    public function testSeeAllHeaders()
    {
        factory(UserTest::class, 1)->create();
        $livewire = Livewire::test(MockTableView::class);
        $headers = ['name', 'email'];

        foreach ($headers as $header) {
            $livewire->assertSee($header);
        }
    }

    public function testSeeAllDataOnTheTable()
    {
        $users = factory(UserTest::class, 7)->create();

        Livewire::test(MockTableView::class)
            ->assertSeeUsers($users);
    }

	public function testSeeTrClassOnTable()
	{
		$users = factory(UserTest::class, 7)->create();

		Livewire::test(MockTableView::class)
			->assertSeeHtml('<tr class="border-b border-gray-200 text-sm class-tr" wire:key="1">');
	}

    public function testSeeAllDataSettingAModelClass()
    {
        $users = factory(UserTest::class, 7)->create();

        Livewire::test(MockTableViewWithModelClass::class)
            ->assertSeeUsers($users);
    }
}
