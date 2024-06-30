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
function substr_remove(string &$string, int $start, int $length = null): string
{
    if (empty($length)) {
        $substr = substr($string, $start);
        $string = substr($string, 0, $start);
    }
    else {
        $substr = substr($string, $start, $length);
        $string = substr_replace($string, '', $start, $length);
    }
    return $substr;
}

/**
 * Applies a mask to a string using the "#" as wildcard.
 * 
 * Ex.: mask('###.###.###-##', '12345678900') => '123.456.789-00'
 * 
 * To escape a #, use "\".
 * 
 * @param string $mask
 * @param string $string
 * @return string
 */
function mask(string $mask, string $string): string
{
    $mask   = str_replace('%', '%%', $mask);
    $format = preg_replace_callback('/(\\\*)(#)/', function ($m) {
        $place = (strlen($m[1]) % 2) == 0 ? '%s' : $m[2];
        return stripslashes($m[1]) . $place;
    }, $mask);
    
    $return = sprintf($format, ...str_split($string));
    return $return;
}
