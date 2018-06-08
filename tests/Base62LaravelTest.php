<?php

namespace Base62\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Base62\Base62ServiceProvider;
use Base62\Facades\Base62;

class Base62LaravelTest extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [Base62ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Base62' => Base62::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default driver to use base62 encoder
        $app['config']->set('base62.driver', 'gmp');
    }

    public function testSimpleEncode()
    {
        $this->assertSame(Base62::encode('0'), '0');
    }
}
