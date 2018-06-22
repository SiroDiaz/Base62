<?php

namespace Base62\Drivers;

use Base62\Drivers\BaseEncoder;
use Base62\Base62;
use InvalidArgumentException;

/**
 * BcmathEncoder is the driver for encode and decode big integers.
 *
 * @package   Base62
 * @author    Siro Díaz Palazón <sirodiaz93@gmail.com>
 * @copyright 2018 Siro Díaz Palazón
 * @license   http://www.opensource.org/licenses/MIT The MIT License
 */
class BcmathEncoder implements BaseEncoder
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
        
        $number = (string) $number;
        $encodedNumber = '';
        while (bccomp($number, '0') === 1) {
            $remainder = bcmod($number, '62');
            $encodedNumber = Base62::CHARS[(int)$remainder] . $encodedNumber;
            $number = bcdiv($number, '62');
        }
        
        return $encodedNumber;
    }

    /**
     *
     * @inheritdoc
     *
     * @return string $number The number encoded
     */
    public function decode($data)
    {
        if (!is_string($data) || !preg_match("/^[a-zA-Z0-9]+$/", $data)) {
            throw new InvalidArgumentException('Must be a base 62 valid string');
        }

        $val = 0;
        $base62Chars = array_reverse(str_split($data));
        $chars = str_split(Base62::CHARS);
        
        foreach ($base62Chars as $index => &$character) {
            $val = bcadd($val, bcmul(array_search($character, $chars), bcpow(Base62::BASE_LENGTH, $index)));
        }
        
        return $val;
    }
}
