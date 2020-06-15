<?php

namespace LaravelViews\Test;

use LaravelViews\LaravelViewsServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends TestbenchTestCase
{
    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        $this->withFactories(__DIR__.'/Database/factories');

        // and other test setup steps you need to perform
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            LaravelViewsServiceProvider::class
        ];
    }
}
