<?php

namespace LaravelViews\Test;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use LaravelViews\LaravelViewsServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Spatie\LaravelRay\RayServiceProvider;

class TestCase extends TestbenchTestCase
{
    use InteractsWithViews;
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
//            \Spatie\LaravelRay\RayServiceProvider::class,
            LivewireServiceProvider::class,
            LaravelViewsServiceProvider::class,
        ];
    }
}
