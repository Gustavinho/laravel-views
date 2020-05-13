<?php

namespace Gustavinho\LaravelViews\Test;

use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [LivewireServiceProvider::class];
    }
}
