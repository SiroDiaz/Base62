<?php

namespace Base62\Drivers;

use Base62\Drivers\BaseEncoder;

class GmpEncoder implements BaseEncoder
{
    public function encode($number)
    {
        if (!preg_match("/^(\d)+$/", (string) $number)) {
            return false;
        }

        if ($number == 0) {
            return '0';
        }
        
        $gmpNumber = gmp_init($number);
        $encodedNumber = '';
        while (gmp_cmp($gmpNumber, '0') === 1) {
            $remainder = gmp_mod($gmpNumber, '62');
            $encodedNumber = $this->$chars[(int)((string)$remainder)] . $encodedNumber;
            $number = $number->dividedBy(62, RoundingMode::DOWN);
        }

        return $encodedNumber;
    }

    public function decode($data)
    {
        
    }
}