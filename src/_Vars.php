<?php
/**
 * Additional functions to manipulate values and variables.
 *
 * @author Rafael M. Salvioni
 */

/**
 * Receives many arguments and returns the first not null.
 *
 * @param mixed $value
 * @return mixed
 */
function coalesce($value)
{
    $args = func_get_args();
    while (!empty($args)) {
        $value = array_shift($args);
        if (!is_null($value)) {
            return $value;
        }
    }
    return null;
}

/**
 * Dumps a value and return it string.
 *
 * @param mixed $value
 * @return string
 */
function dump($value)
{
    ob_start();
    var_dump($value);
    return ob_get_end();
}

/**
 * Checks is a value is a number, integer or double.
 * 
 * @param mixed $var
 * @return bool
 */
function is_number($var)
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