<?php

namespace Base62;

use Brick\Math\BigInteger;
use Brick\Math\RoundingMode;

class Base62 {

  /**
   * @var string $chars Contains all valid characters
   */
   
  private static $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

  /**
	 *	method to encode data to base62
	 *
	 *	@param mixed $number the number to convert to base62
	 *	@return mixed if is a valid number will return a string
	 *			else returns false
	 */

  public static function encode($number) {
    if ($number == 0) {
      return '0';
    }

    $encodedNumber = '';
    if((int) $number >= PHP_INT_MAX) {
      $number = BigInteger::of($number);
      while($number->isGreaterThan(0)) {
        $remainder = $number->remainder(62, RoundingMode::DOWN);
        $encodedNumber = self::$chars[$remainder->toInteger()] . $encodedNumber;
        $number = $number->dividedBy(62, RoundingMode::DOWN);
      }

      return $encodedNumber;
    }

    while($number > 0) {
      $encodedNumber = self::$chars[$number % 62] . $encodedNumber;
      $number = floor($number / 62);
    }

    return $encodedNumber;
  }

  /**
	 * decode the string to obtain the number
	 *
	 * @param string $base62 the base62 encoded number
	 * @return mixed false if the base doesn't matches
	 *			or if the position is less than 0.
	 *			String the decoded string
	 */

  public static function decode($base62) {
    if(!is_string($base62)) {
      return 0;
    }

    $val = 0;
    $base62Chars = array_reverse(str_split($base62));
    $chars = str_split(self::$chars);
    foreach($base62Chars as $index => $character) {
      $val += array_search($character, $chars) * pow(62, $index);
    }

    return $val;
  }
}
