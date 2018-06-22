<?php
/**
 * GmpEncoder.php
 * @author    Siro Diaz Palazon <sirodiaz93@gmail.com>
 * @copyright 2018 Siro Diaz
 * @license   MIT
 * @see       https://github.com/SiroDiaz/Base62
 */
namespace Base62\Drivers;

use Base62\Drivers\BaseEncoder;
use InvalidArgumentException;

/**
 * This class is the GMP driver for encode and decode integers or
 * base 62 strings.
 */
class GmpEncoder implements BaseEncoder
{
    /**
     *
     * @inheritdoc
     *
     * @return string $number The number decoded but as string
     */
    public function encode($number)
    {
        if (!preg_match("/^(\d)+$/", (string) $number)) {
            throw new InvalidArgumentException('The value can only accept numbers');
        }
        if ($number === 0) {
            return '0';
        }
        
        $base62 = gmp_strval(gmp_init($number, 10), 62);

        return $base62;
    }

    /**
     * @inheritdoc
     *
     * @return string $number The number decoded but as string
     */
    public function decode($data)
    {
        if (!is_string($data)) {
            throw new InvalidArgumentException('Must be a base 62 valid string');
        }

        $number = gmp_strval(gmp_init($data, 62), 10);
        
        return $number;
    }
}