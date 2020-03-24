<?php

namespace Christophrumpel\LaravelFactoriesReloaded\Tests;

use Christophrumpel\LaravelFactoriesReloaded\LaravelFactoriesReloadedServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class TestCase extends \Orchestra\Testbench\TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        Config::set('factories-reloaded.models_path', __DIR__.'/Models');
        Config::set('factories-reloaded.vanilla_factories_path', __DIR__.'/database/factories');
        Config::set('factories-reloaded.factories_path', __DIR__.'/tmp');
        Config::set('factories-reloaded.factories_namespace',
            'Christophrumpel\LaravelFactoriesReloaded\Tests\Factories');

        File::copyDirectory(__DIR__.'/Factories', Config::get('factories-reloaded.factories_path'));

        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function tearDown(): void
    {
        File::deleteDirectory(Config::get('factories-reloaded.factories_path'));

        parent::tearDown();
    }

    /**
     * add the package provider
     *
     * @param $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [LaravelFactoriesReloadedServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param  Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
    }
}
