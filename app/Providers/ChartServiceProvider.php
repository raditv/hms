<?php

namespace App\Providers;

use App\Services\Chart\Chart;
use Illuminate\Support\ServiceProvider;
/**
 * Class ChartServiceProvider
 * @package App\Providers
 */
class ChartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    protected $defer = false;

    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind('chart', function ($app) {
            return new Chart($app);
        });
    }
}