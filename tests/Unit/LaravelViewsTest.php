<?php

namespace LaravelViews\Test\Unit;

use LaravelViews\Facades\LaravelViews;
use LaravelViews\Test\TestCase;

class LaravelViewsTest extends TestCase
{
    public function testRenderCssLinks()
    {
        $css = LaravelViews::css();

        $this->assertEquals(
            $css,
            implode("\n", [
                \Livewire\Livewire::styles(),
                '<link rel="stylesheet" href="' . asset('/vendor/tailwind.css') . '" />',
                '<link rel="stylesheet" href="' . asset('/vendor/laravel-views.css') . '" />',
            ])
        );
    }

    public function testRenderJsLinks()
    {
        $js = LaravelViews::js();
        $this->assertEquals(
            $js,
            \Livewire\Livewire::scripts().PHP_EOL.
            '<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>'.PHP_EOL.
            '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>'.PHP_EOL.
            '<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>'.PHP_EOL.
            '<script src="' . asset('/vendor/laravel-views.js') . '" type="text/javascript" defer></script>'
        );
    }

    public function testRenderCustomizedCssLinks()
    {
        $css = LaravelViews::css('laravel-views,livewire');

        $this->assertEquals(
            $css,
            \Livewire\Livewire::styles()."\n".
            '<link rel="stylesheet" href="' . asset('/vendor/laravel-views.css') . '" />'
        );
    }

    public function testRenderCustomizedJsLinks()
    {
        $js = LaravelViews::js('laravel-views');

        $this->assertEquals(
            $js,
            '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>'.PHP_EOL.
            '<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>'.PHP_EOL.
            '<script src="' . asset('/vendor/laravel-views.js') . '" type="text/javascript" defer></script>'
        );

        $js = LaravelViews::js('laravel-views,alpine');

        $this->assertEquals(
            $js,
            '<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>'.PHP_EOL.
            '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>'.PHP_EOL.
            '<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>'.PHP_EOL.
            '<script src="' . asset('/vendor/laravel-views.js') . '" type="text/javascript" defer></script>'
        );
    }
}
