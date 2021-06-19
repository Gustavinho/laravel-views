<?php

namespace LaravelViews\Test\Unit;

use LaravelViews\Facades\Variants;
use LaravelViews\Test\TestCase;
use LaravelViews\UI\Variants as UIVariants;

class VariantsTest extends TestCase
{
    public function testVariantsHelper()
    {
        $this->assertInstanceOf(UIVariants::class, variants());
    }

    public function testButtonVariants()
    {
        $this->assertTrue(
            Variants::button('primary')->class() ===
            'text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500'
        );
        $this->assertEquals(
            Variants::button('primary-light')->class(),
            'text-blue-700 border border-blue-600 hover:bg-blue-600 hover:text-white focus:bg-blue-600 focus:text-white active:bg-blue-600 active:text-white'
        );
    }

    public function testAlertVariants()
    {
        $this->assertEquals(
            Variants::alert('success')->class('base'),
            'bg-green-100 border-green-300 text-green-700'
        );
        $this->assertEquals(
            Variants::alert('danger')->class('icon'),
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
            Variants::alert('danger')->icon(),
            'x'
        );
    }

    public function testBadgeVariants()
    {
        $this->assertEquals(
            Variants::badge('success')->class(),
            'bg-green-200 text-green-800'
        );
    }

    public function testImgVariants()
    {
        $this->assertEquals(
            Variants::img('avatar')->class(),
            'h-8 w-8 object-cover rounded-full shadow-inner'
        );
        $this->assertEquals(
            Variants::img()->class(),
            ''
        );
    }

    public function testVarianstHelperUsingVariantPaths()
    {
        $this->assertEquals(
            variants('images.avatar'),
            'h-8 w-8 object-cover rounded-full shadow-inner'
        );

        $this->assertEquals(
            variants('alerts.warning.title'),
            'text-green-900'
        );

        $this->assertInstanceOf(
            UIVariants::class,
            variants()
        );
    }
}
