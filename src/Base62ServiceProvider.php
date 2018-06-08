<?php

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
    }
}
