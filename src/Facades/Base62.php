<?php

namespace Base62\Facades;

use Illuminate\Support\Facades\Facade;

class Base62 extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Base62';
    }
}