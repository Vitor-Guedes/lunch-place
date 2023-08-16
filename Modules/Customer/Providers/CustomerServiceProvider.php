<?php

namespace Modules\Customer\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Customer\Services\CustomerService;
use Modules\Ultils\Services\Api\HandlerService;

class CustomerServiceProvider
extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Customer';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'customer';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/mocky_test.php') => config_path($this->moduleNameLower . '.php'),
        ], 'mocky_test');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/mocky_test.php'), $this->moduleNameLower
        );
    }
}