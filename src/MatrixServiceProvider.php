<?php

namespace Updivision\Matrix;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class MatrixServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $source = dirname(__DIR__).'/src/config/matrix.php';
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('matrix.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('matrix');
        }
        $this->mergeConfigFrom($source, 'matrix');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('matrix', function ($app) {
            $config = $app->make('config')->get('matrix');
            return new Matrix($config['domain']);
        });
        $this->app->alias('matrix', '\Updivision\Matrix\Matrix');
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['matrix', '\Updivision\Matrix\Matrix'];
    }
}
