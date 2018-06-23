<?php
/**
 * Base62.php
 * @author    Siro Diaz Palazon <sirodiaz93@gmail.com>
 * @copyright 2018 Siro Diaz
 * @license   MIT
 * @see       https://github.com/SiroDiaz/Base62
 */
namespace Base62\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Base62 facade class for Laravel.
 */
class Base62 extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Base62';
    }
}
