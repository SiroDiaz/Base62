<?php
/**
 * BaseEncoder.php
 * @author    Siro Diaz Palazon <sirodiaz93@gmail.com>
 * @copyright 2018 Siro Diaz
 * @license   MIT
 * @see       https://github.com/SiroDiaz/Base62
 */

namespace Base62\Drivers;

/**
 * BaseEncoder is the driver interface that must be implemented by
 * all drivers.
 */
interface BaseEncoder
{
    /**
     * Encodes a positive number passed as a string.
     *
     * @param string $number The number passed as a string.
     */
    public function encode($number);
    
    /**
     * Decodes a a base 62 string and returns a positive number as string.
     *
     * @param string $data The string passed as a string.
     */
    public function decode($data);
}
