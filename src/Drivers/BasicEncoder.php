<?php
/**
 * BasicEncoder.php
 * @author    Siro Diaz Palazon <sirodiaz93@gmail.com>
 * @copyright 2018 Siro Diaz
 * @license   MIT
 * @see       https://github.com/SiroDiaz/Base62
 */
namespace Base62\Drivers;

use Base62\Base62;
use Base62\Drivers\BaseEncoder;
use InvalidArgumentException;

/**
 * BasicEncoder is the native PHP driver.
 * It has two public methods, inherited from the BaseEncoder abstract class.
 */
class BasicEncoder implements BaseEncoder
{
    /**
     *
     * @inheritdoc
     *
     * @return string $number The number decoded but as string
     */
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

    /**
     *
     * @inheritdoc
     *
     * @return string $number The number decoded but as string
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
            $val += array_search($character, $chars) * pow(Base62::BASE_LENGTH, $index);
        }

        return $val === 0 ? '0' : (string) $val;
    }

    /**
     * Checks if the number is positive and valid ([0-9]+), and then
     * checks if the number is lower or equal to the maximum integer
     * available in PHP.
     *
     * @param int   $number
     * @return bool
     */
    private function isValidNumber($number)
    {
        $number = (string) $number;

        return ctype_digit($number) && !$this->isBigInteger($number);
    }

    /**
     * Determines if is a big integer compared
     *
     * @param string $number
     * @return bool  True if $number is greater than PHP_INT_MAX (maximum integer).
     */
    private function isBigInteger($number)
    {
        if (function_exists('gmp_init')) {
            $gmpInt1 = gmp_init($number);
            $gmpInt2 = gmp_init((string) PHP_INT_MAX);

            return gmp_cmp($gmpInt1, $gmpInt2) >= 1;
        } else if (function_exists('bccomp')) {
            return bccomp($number, (string) PHP_INT_MAX) === 1;
        }

        return true;
    }
}
