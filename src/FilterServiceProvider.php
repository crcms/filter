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

        $drives = $this->app['config']->get('filter.drives');
        $data = $this->app['request']->all();

        //
        $this->app->singleton('input', function () use ($drives, $data) {
            $input = new Input($data);

            array_map(function ($value) use ($input) {
                $input->filter(new $value);
            }, $drives);

            return $input;
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['input'];
    }
}