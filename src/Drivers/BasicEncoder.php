<?php

namespace Base62\Drivers;

use Base62\Base62;
use Base62\Drivers\BaseEncoder;
use InvalidArgumentException;

/**
 * 
 */
class BasicEncoder extends BaseEncoder
{
    public function encode($number)
    {
        if (!$this->isValidNumber($number)) {
            throw new InvalidArgumentException('Invalid number for BasicEncoder');
        }
        if ($number === 0 || $number === '0') {
            return '0';
        }

        $encodedNum = '';
        
        while ($number > 0) {
            $encodedNum = Base62::CHARS[$number % Base62::BASE_LENGTH] . $encodedNum;
            $number = (int) (floor($number) / Base62::BASE_LENGTH);
        }

        return $encodedNum;
    }

    public function decode($data)
    {
        if (!is_string($data) || !preg_match("/^[a-zA-Z0-9]+$/", $data)) {
            throw new InvalidArgumentException('Must be a base 62 valid string');
        }

        $val = 0;
        $base62Chars = array_reverse(str_split($data));
        $chars = str_split(Base62::CHARS);
        foreach ($base62Chars as $index => &$character) {
            $val += array_search($character, $chars) * pow(Base62::BASE_LENGTH, $index);
        }

        return $val === 0 ? '0' : (string) $val;
    }

    private function isValidNumber($number)
    {
        $number = (string) $number;
        return ctype_digit($number) && !$this->isGreaterThan($number, PHP_INT_MAX);
    }

    private function isGreaterThan($num1, $num2)
    {
        if (function_exists('gmp_init')) {
            $gmpInt1 = gmp_init($num1);
            $gmpInt2 = gmp_init($num2);
            return gmp_cmp($gmpInt1, $gmpInt2) === 1;
        } else if (function_exists('bccomp')) {
            return bccomp($num1, $num2) === 1;
        }

        return (int) $num1 > (int) $num2;
    }
}