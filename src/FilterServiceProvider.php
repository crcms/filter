<?php

namespace CrCms\Filter;

use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @var string
     */
    protected $configPath = __DIR__ . '/../config/filter.php';

    /**
     *
     */
    public function boot()
    {
        $this->publishes([
            $this->configPath => config_path('filter.php'),
        ]);
    }

    /**
     *
     */
    public function register()
    {
        //合并filter config
        $this->mergeConfigFrom($this->configPath, 'filter');

        $this->app->alias('input', FilterInterface::class);

        //
        $this->app->singleton('input', function ($app) {
            $input = new Input($app['request']->all());
            $input->filter($app['config']->get('filter.default'));

            return $input;
        });
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return ['input'];
    }
}