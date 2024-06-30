<?php
/**
 * Additional functions to manipulate values and variables.
 *
 * @author Rafael M. Salvioni
 */

/**
 * Returns first non-null argument given
 * 
 * @param mixed[...] $value Value
 * @return ?mixed
 */
function coalesce(...$values)
{
    foreach ($values as &$v) {
        if (!is_null($v)) {
            return $v;
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
function dump($value): string
{
    ob_start();
    var_dump($value);
    return ob_get_end();
}

/**
 * Checks is a value is a number (int or float).
 * 
 * Returns false to numeric strings
 * 
 * @param mixed $var
 * @return bool
 */
function is_number($var): bool
{
    return is_int($var) || is_float($var);
}

/**
 * Create a class instance without call its constructor.
 * 
 * @param string $class Class name
 * @return object
 */
function create_instance(string $class): object
{
    return unserialize(
        sprintf(
            'O:%d:"%s":0:{}',
            strlen($class),
            $class
        )
    );
}