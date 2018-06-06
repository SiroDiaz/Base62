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
 * 
 */
abstract class BaseEncoder
{
    /**
     * 
     */
    abstract public function encode($number);
    /**
     * 
     */
    abstract public function decode($data);
}