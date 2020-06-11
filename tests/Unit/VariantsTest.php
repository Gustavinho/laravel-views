<?php

namespace Gustavinho\LaravelViews\Test\Unit;

use Gustavinho\LaravelViews\Facades\Variants;
use Gustavinho\LaravelViews\Test\TestCase;

class VariantsTest extends TestCase
{
    public function testButtonVariants()
    {
        $this->assertEquals(
            Variants::button('primary')->class(),
            'text-white bg-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-500'
        );
        $this->assertEquals(
            Variants::button('primary-light')->class(),
            'text-blue-700 bg-blue-200 hover:bg-blue-600 hover:text-white focus:bg-blue-600 focus:text-white active:bg-blue-600 active:text-white'
        );
    }

    public function testAlertVariants()
    {
        $this->assertEquals(
            Variants::alert('success')->class('base'),
            'bg-green-100 border-green-300 text-green-700'
        );
        $this->assertEquals(
            Variants::alert('error')->class('icon'),
            'bg-red-200'
        );
        $this->assertEquals(
            Variants::alert('warning')->class('title'),
            'text-green-900'
        );
        $this->assertEquals(
            Variants::alert('success')->title(),
            'Success'
        );
        $this->assertEquals(
            Variants::alert('error')->icon(),
            'x'
        );
    }
}
