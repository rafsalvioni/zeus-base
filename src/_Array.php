<?php
/**
 * Additional functions to manipulate arrays.
 *
 * @author Rafael M. Salvioni
 */

namespace Zeus\Base\Arrays;

/**
 * Checks if a array is associative.
 *
 * @param array $array Array
 * @return bool
 */
function is_assoc(array $array): bool
{
    $keys = \array_keys($array);
    foreach ($keys as $idx => &$key) {
        if ($idx !== $key) {
            return true;
        }
    }
    return false;
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
function queue(array &$array, &$value): bool
{
    if (!empty($array)) {
        $value = \array_shift($array);
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
function last(array $array)
{
    return \array_pop($array);
}
