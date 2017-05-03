<?php
/**
 * Additional functions to manipulate values and variables.
 *
 * @author Rafael M. Salvioni
 */

namespace Zeus\Base\Vars;

/**
 * Dumps a value and return it string.
 *
 * @param mixed $value
 * @return string
 */
function dump($value): string
{
    \ob_start();
    \var_dump($value);
    return ob_get_end();
}

/**
 * Checks if a value is composite.
 * 
 * Are considered composite values arrays and objects.
 * 
 * @param mixed $var
 * @return bool
 */
function is_composite($var): bool
{
    return \is_array($var) || \is_object($var);
}

/**
 * Checks is a value is a number, integer or double.
 * 
 * @param mixed $var
 * @return bool
 */
function is_number($var): bool
{
    return \is_int($var) || \is_float($var);
}

/**
 * Create a class instance without call its constructor.
 * 
 * @param string $class Class name
 * @return object
 */
function create_instance($class)
{
    return \unserialize(
        \sprintf(
            'O:%d:"%s":0:{}',
            \strlen($class),
            $class
        )
    );
}