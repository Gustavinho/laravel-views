<?php

namespace LaravelViews\Test;

use LaravelViews\LaravelViewsServiceProvider;
use Livewire\Livewire;
use Livewire\LivewireServiceProvider;
use Livewire\Testing\TestableLivewire;
use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Spatie\LaravelRay\RayServiceProvider;

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

        /**
         * Macro to check if a user is present in the HTML code
         * @example $livewire->assertSeeUsers($users)
         */
        TestableLivewire::macro('assertSeeUsers', function ($users, $assert = 'assertSee') {
            foreach ($users as $user) {
                $this->$assert(htmlspecialchars_decode($user->name))
                    ->$assert($user->email);
            }

            return $this;
        });

        /**
         * Macro to check if a user is not present in the HTML code
         * @example $livewire->assertDontSeeUsers($users)
         */
        TestableLivewire::macro('assertDontSeeUsers', function ($users) {
            return TestableLivewire::assertSeeUsers($users, 'assertDontSee');
        });
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
