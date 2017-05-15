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
function array_is_assoc(array $array)
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
function array_queue(array &$array, &$value)
{
    if (!empty($array)) {
        $value = \array_shift($array);
        return true;
    }
    $value = null;
    return false;
}

/**
 * Retorna o valor de um array a partir de sua chave.
 * 
 * Se o array for multidimensional, $key pode ser um array de chaves ou
 * uma string onde as chaves estão separadas por pontos.
 *
 * Caso a chave não exista, retorna valor passado para $defaultValue.
 *
 * @param array $array Array
 * @param string|Integer|array $key Chave
 * @param mixed $defaultValue Valor padrão
 * @return mixed
 */
function array_get(array $array, $key, $defaultValue = null)
{
    if (!\is_array($key)) {
        $key = \explode('.', $key);
    }
    
    $found = true;
    foreach ($key as &$k) {
        if (\is_array($array) && \array_key_exists($k, $array)) {
            $array = $array[$k];
        }
        else {
            $found = false;
            break;
        }
    }
    return $found ? $array : $defaultValue;
}

/**
 * Returns the last element of a array.
 * 
 * If is a associative array, it will be converted to indexed.
 *
 * @param array $array
 * @return mixed
 */
function array_last(array $array)
{
    return array_pop($array);
}
