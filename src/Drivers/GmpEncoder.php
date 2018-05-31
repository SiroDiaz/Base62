<?php

namespace Base62\Drivers;

use Base62\Drivers\BaseEncoder;
use InvalidArgumentException;

class GmpEncoder extends BaseEncoder
{
    public function encode($number)
    {
        if (!preg_match("/^(\d)+$/", (string) $number)) {
            throw new InvalidArgumentException('The value can only accept numbers');
        }
        if ($number === 0) {
            return '0';
        }
        
        /*
        $gmpNumber = gmp_init($number);
        $encodedNumber = '';
        while (gmp_cmp($gmpNumber, '0') === 1) {
            $remainder = gmp_mod($gmpNumber, '62');
            $encodedNumber = $this->$chars[(int)((string)$remainder)] . $encodedNumber;
            $number = $number->dividedBy(62, RoundingMode::DOWN);
        }
        */

        $base62 = gmp_strval(gmp_init($number, 10), 62);

        return $base62;
    }

    public function decode($data)
    {
        if (!is_string($data)) {
            throw new InvalidArgumentException('Must be a base 62 valid string');
        }

        $hex = gmp_strval(gmp_init($data, 62), 10);
        
        return $hex;
    }
}