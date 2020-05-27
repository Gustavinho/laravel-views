<?php

namespace Gustavinho\LaravelViews\Test\Unit;

use Gustavinho\LaravelViews\Facades\LaravelViews;
use Gustavinho\LaravelViews\Test\TestCase;

class LaravelViewsTest extends TestCase
{
    public function testRenderCssLinks()
    {
        $css = LaravelViews::css();

        $this->assertEquals(
            $css,
            \Livewire\Livewire::styles()."\n".
            '<link rel="stylesheet" href="http://test-packages.test/vendor/laravel-views.css" />'
        );
    }

    public function testRenderJsLinks()
    {
        $js = LaravelViews::js();

        $this->assertEquals(
            $js,
            \Livewire\Livewire::scripts()."\n".
            '<script src="http://test-packages.test/vendor/laravel-views.js" type="text/javascript"></script>'
        );
    }
}
