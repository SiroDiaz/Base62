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
        // evaluate if the number is in a valid format
        if (!preg_match("/^(\d)+$/", (string) $number)) {
            throw new InvalidArgumentException('The value can only accept numbers');
        }
        if ($number === 0) {
            return '0';
        }

        $encodedNum = '';

        while ($number > 0) {
            $encodedNum = Base62::CHARS[abs($number) % Base62::BASE_LENGTH] . $encodedNum;
            $number = floor(abs($number) / Base62::BASE_LENGTH);
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
}