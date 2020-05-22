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
            '<style>[wire\:loading] {display: none;}[wire\:offline] {display: none;}[wire\:dirty]:not(textarea):not(input):not(select) {display: none;}</style>
<link rel="stylesheet" href="http://localhost/vendor/laravel-views.css">'
        );
    }
}
