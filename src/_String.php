<?php
/**
 * Additional functions to manipulate strings.
 *
 * @author Rafael M. Salvioni
 */

/**
 * The same of PHP's substr(), however its remove the selected substring of
 * the source string.
 * 
 * @param string $string
 * @param int $start
 * @param int $length
 * @return string
 */
function substr_remove(&$string, $start, $length = null)
{
    if (empty($length)) {
        $substr = substr($string, $start);
        $string = substr($string, 0, $start);
    }
    else {
        $substr = substr($string, $start, $length);
        if ($length >= 0) {
            $string = substr($string, 0, $start) . substr($string, $start + $length);
        }
        else {
            $string = substr($string, 0, $start) . substr($string, $length);
        }
    }
    return $substr;
}