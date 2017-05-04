<?php
/**
 * Additional functions to manipulate arrays.
 *
 * @author Rafael M. Salvioni
 */

/**
 * Checks if a array is associative.
 *
 * @param array $array Array
 * @return bool
 */
function array_is_assoc(array $array): bool
{
    return array_values($array) !== $array;
}

/**
 * Emptys a array, putting the dropped values on $value parameter.
 *
 * Returns true if array isn't empty, false otherwise.
 *
 * @param array $array
 * @param mixed $value
 * @return bool
 */
function array_queue(array &$array, &$value): bool
{
    if (!empty($array)) {
        $value = array_shift($array);
        return true;
    }
    $value = null;
    return false;
}

/**
 * Returns the last element of a array.
 * 
 * @param array $array
 * @return mixed
 */
function array_last(array $array)
{
    return array_pop($array);
}
