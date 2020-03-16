<?php

namespace Gustavinho\LaravelViews\Test\Unit;

use Gustavinho\LaravelViews\Filters\Filter;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class ExampleTest extends Filter
{
}

class ExampleTestWithTitle extends Filter
{
    protected $title = 'My custom title';
}

class FilterTest extends FrameworkTestCase
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
