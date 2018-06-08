<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Base62 driver
    |--------------------------------------------------------------------------
    |
    | Set the default driver to use within your application.
    | Available drivers are:
    | - 'basic': The default PHP encoder with support for 32 or 64 bits
    |            depending on the PHP version installed.
    | - 'gmp': Ideal driver if GMP extension is installed and loaded in php.ini
    | - 'bcmath': Slower but supports big integers as GMP extension.
    |
    */
    'driver' => 'basic',

];
