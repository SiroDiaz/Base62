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
use Base62\Drivers\EncoderFactory;

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
    const CHARS = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    /**
     * Pre computed base 62 characters in reverse order for improve performance.
     *
     * @var string REVERSE_CHARS contains CHARS constant in reverse order.
     */
    const REVERSE_CHARS = 'zyxwvutsrqponmlkjihgfedcbaZYXWVUTSRQPONMLKJIHGFEDCBA9876543210';
    
    /**
     * Pre computed base 62 string length. Better than strlen(Base62::CHARS).
     *
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
    public function __construct($encoder = 'basic')
    {
        $encoderFactory = new EncoderFactory();
        $this->encoder = $encoderFactory->getEncoder($encoder);
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
    }
}
