<?php
/**
 * EncoderFactory.php
 * @author    Siro Diaz Palazon <sirodiaz93@gmail.com>
 * @copyright 2018 Siro Diaz
 * @license   MIT
 * @see       https://github.com/SiroDiaz/Base62
 */
namespace Base62\Drivers;

/**
 * Factory method implementation for generate a driver encoder by name.
 * Allowed drivers are 'gmp', 'basic', and 'bcmath'.
 */
class EncoderFactory
{
    /**
     * Generates an encoder and returns the instance.
     *
     * @param string $type The type of encoder to instantiate.
     *      Only availables "gmp", "basic" and "bcmath".
     * @throws Base62\Drivers\Exceptions\DriverNotFoundException
     * @return Base62\Drivers\BaseEncoder an instance of a avalilable driver.
     */
    public function getEncoder($type)
    {
        $className = $this->generateClassName($type);
        if (!class_exists($className)) {
            throw new DriverNotFoundException('EncoderNotFound');
        }

        return new $className();
    }

    /**
     * Generate a string with the namespace and class name for a given
     * encoder name.
     *
     * @param string  $encoderName The encoder name.
     * @return string The full namespace and class name concatenated.
     */
    private function generateClassName($encoderName)
    {
        $classNamespace = 'Base62\\Drivers\\';
        $driverName = ucfirst(strtolower($encoderName)) . 'Encoder';
        return $classNamespace . $driverName;
    }
}
