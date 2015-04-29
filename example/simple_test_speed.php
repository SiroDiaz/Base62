<?php

require __DIR__ .'/../vendor/autoload.php';

use Base62 as B62;

/*
 * 32 bit builds of PHP:
 *     Integers can be from -2147483648 to 2147483647
 * 64 bit builds of PHP:
 *     Integers can be from -9223372036854775808 to 9223372036854775807
 *
 *
 * In 64 bit PHP version it will be FASTER
 * and must be checked if the number is over the max
 * int size supported. Because create an object is slower
 * than native type. Run this script and you will check it.
 */


// ------------------------------------------------------
// _______ EQUAL OR UNDER MAX INT (32 bit tested) _______
// ------------------------------------------------------

echo "-------- TEST WITHOUT Math_BigInteger --------\n\n";

$start = microtime(true) * 1000;
$max = PHP_INT_MAX;
echo "\tBase62 bigint encoded: ". B62\Base62::encode($max) ."\n";
echo "\tExecution time: ". floor(microtime(true) * 1000 - $start) ."ms\n\n";
echo memory_get_usage(true) / 1024 ." KB\n";
// ------------------------------------------------------
// ____________ OVER MAX INT (32 bit tested) ____________
// ------------------------------------------------------

echo "-------- TEST WITH Math_BigInteger --------\n\n";

$start = microtime(true) * 1000;
$id = new Math_BigInteger((string)(PHP_INT_MAX + 1), 10);
echo "\tBase62 bigint encoded: ". B62\Base62::encode($id) ."\n";
echo "\tExecution time: ". floor(microtime(true) * 1000 - $start) ."ms\n";
echo memory_get_usage(true) / 1024 ." KB\n";