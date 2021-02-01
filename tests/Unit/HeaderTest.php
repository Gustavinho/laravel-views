<?php

namespace LaravelViews\Test\Unit;

use LaravelViews\Facades\Header;
use LaravelViews\Test\TestCase;

class HeaderTest extends TestCase
{
    public function testSetTitle()
    {
        $header = Header::title('My header');
        $this->assertEquals($header->title, 'My header');
    }

    public function testSetSortBy()
    {
        $header = Header::sortBy('title');
        $this->assertEquals($header->sortBy, 'title');
        $this->assertTrue($header->isSortable());
    }

    public function testSetWidth()
    {
        $header = Header::width('100px');
        $this->assertEquals($header->width, '100px');
    }
}
