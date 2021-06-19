<?php

namespace LaravelViews\Test\Unit;

use LaravelViews\Filters\Filter;
use LaravelViews\Test\TestCase;

class ExampleTest extends Filter
{
}

class ExampleTestWithTitle extends Filter
{
    protected $title = 'My custom title';
}

class FilterTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetTitle()
    {
        $filter = new ExampleTest();
        $filterWithTitle = new ExampleTestWithTitle();

        $this->assertEquals($filter->getTitle(), 'Example Test');
        $this->assertEquals($filterWithTitle->getTitle(), 'My custom title');
    }
}
