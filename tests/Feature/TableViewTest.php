<?php

namespace Gustavinho\LaravelViews\Test\Feature;

use Gustavinho\LaravelViews\Test\TestCase;
use Gustavinho\LaravelViews\Views\TableView;
use Livewire\Livewire;

class TableViewExample extends TableView
{
    public function headers()
    {
        return [];
    }

    public function filters()
    {
        return [];
    }

    public function repository()
    {
        return null;
    }
}

class TableViewTest extends TestCase
{
    public function testFirstTest()
    {
        $this->assertEquals(true, true);
        // Livewire::test(TableViewExample::class);
    }
}
