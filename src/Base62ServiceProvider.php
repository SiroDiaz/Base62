<?php
/**
 * Base62ServiceProvider.php
 * @author    Siro Diaz Palazon <sirodiaz93@gmail.com>
 * @copyright 2018 Siro Diaz
 * @license   MIT
 * @see       https://github.com/SiroDiaz/Base62
 */
namespace Base62;

use Illuminate\Support\ServiceProvider;

/**
 * Base62ServiceProvider is a service provider for the Laravel
 * framework.
 */
class Base62ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfigs();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Base62::class, function ($app) {
            return new Base62($app['config']['base62.driver']);
        });

        $this->app->alias(Base62::class, 'Base62');
        $this->registerConfigs();
    }

    /**
     * Register the publishable files.
     *
     * @return void
     */
    private function registerPublishableResources()
    {
        /*
        $configPath = dirname(__DIR__).'/config';
        $publishable = [
            'config' => [
                "{$configPath}/base62.php" => config_path('base62.php'),
            ],
        ];
        
        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
        */
    }

    /**
     * Register the configuration file in the Laravel or Lumen app.
     *
     * @return void
     */
    public function registerConfigs()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->registerPublishableResources();
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('base62');
        }

        $this->publishes([
            __DIR__.'/../config/base62.php' => config_path('base62.php')
        ], 'base62/base62');
        
        $this->mergeConfigFrom(
            dirname(__DIR__).'/config/base62.php', 'base62'
        );
    }
}
