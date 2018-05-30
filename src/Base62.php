<?php
/**
 * Base62.php
 * @author    Siro Diaz Palazon <sirodiaz93@gmail.com>
 * @copyright 2018 Siro Diaz
 * @license   MIT
 * @see       https://github.com/SiroDiaz/Base62
 */

namespace Base62;

use Base62\Drivers\BaseEncoder;
/**
 * The entry point class that is used to choose a big integer driver
 * and also to bind the encode and decode methods.
 */
class Base62
{
    /**
     * The list of characters availables for the standard base62 encoder/decoder.
     *
     * @var string CHARS constant contains all valid characters.
     */
    const CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Pre computed base 62 characters in reverse order for improve performance.
     *
     * @var string REVERSE_CHARS contains CHARS constant in reverse order.
     */
    const REVERSE_CHARS = 'ZYXWVUTSRQPONMLKJIHGFEDCBAzyxwvutsrqponmlkjihgfedcba9876543210';
    
    /**
     * @var integer
     */
    const BASE_LENGTH = 62;

    /**
     * The encoder used to perform the base 62 operations.
     *
     * @var BaseEncoder
     */
    private $encoder;

    /**
     * Constructor method that recieves an instance of the encoder
     */
    public function __construct(BaseEncoder $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Method to encode data to base62
     *
     * @param mixed $number the number to convert to base62
     * @return mixed if is a valid number will return a string
     *          else returns false
     */
    public function encode($number)
    {
        return $this->encoder->encode($number);
        // evaluate if the number is in a valid format
        if (!preg_match("/^(\d)+$/", (string) $number)) {
            return false;
        }

        if ($number == 0) {
            return '0';
        }

        $encodedNumber = '';
        if ((int) $number >= PHP_INT_MAX) {
            $number = BigInteger::of($number);
            while ($number->isGreaterThan(0)) {
                $remainder = $number->remainder(62, RoundingMode::DOWN);
                $encodedNumber = self::$chars[(int)((string)$remainder)] . $encodedNumber;
                $number = $number->dividedBy(62, RoundingMode::DOWN);
            }

            return $encodedNumber;
        }

        while ($number > 0) {
            $encodedNumber = self::$chars[$number % 62] . $encodedNumber;
            $number = floor($number / 62);
        }

        return $encodedNumber;
    }

    /**
     * Decode the string to obtain the number.
     *
     * @param string $base62 the base62 encoded number
     * @return mixed false if the base doesn't matches
     *           or if the position is less than 0.
     *           String the decoded string
     */

    public function decode($base62)
    {
        return $this->encoder->decode($base62);
        if (!is_string($base62)) {
            return false;
        }

        $val = 0;
        $base62Chars = array_reverse(str_split($base62));
        $chars = str_split(self::$chars);
        foreach ($base62Chars as $index => &$character) {
            $val += array_search($character, $chars) * pow(62, $index);
        }

        return $val;
    }
}
