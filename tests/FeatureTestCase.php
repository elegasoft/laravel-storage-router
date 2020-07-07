<?php


namespace Elegasoft\LaravelStorageRoute\Tests;


use Elegasoft\LaravelStorageRoute\Providers\StorageRouterServiceProvider;
use Orchestra\Testbench\TestCase;

class FeatureTestCase extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [
            StorageRouterServiceProvider::class,
        ];
    }
}