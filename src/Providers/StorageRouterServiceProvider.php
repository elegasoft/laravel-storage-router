<?php


namespace Elegasoft\LaravelStorageRoute\Providers;


use Illuminate\Support\Facades\Gate;

class StorageRouterServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/storage_router.php', 'storage_router'
        );
    }

    /**
     * Register the StorageRoute gate.
     *
     * This gate determines who can access items in storage.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewStorageItems', function ()
        {
            return true;
        });
    }
}