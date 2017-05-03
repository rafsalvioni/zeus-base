<?php
/**
 * Additional functions to manipulate strings.
 *
 * @author Rafael M. Salvioni
 */

namespace Zeus\Base\String;

/**
 * The same of PHP's substr(), however its remove the selected substring of
 * the source string.
 * 
 * @param string $string
 * @param int $start
 * @param int $length
 * @return string
 */
function substr_remove(&$string, int $start, int $length = null): string
{
    if (empty($length)) {
        $substr = \substr($string, $start);
        $string = \substr($string, 0, $start);
    }
    else {
        $substr = \substr($string, $start, $length);
        $string = \substr_replace($string, '', $start, $length);
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
 * @param  string $mask
 * @param  string $string
 * @return string
 */
function mask(string $mask, string $string): string
{
    $string = \str_split($string);
    $return = '';
    
    while (!empty($mask) && !empty($string) && \preg_match('/^(\\\*)(.?)/', $mask, $match)) {
        $escape = (\strlen($match[1]) % 2) > 0;
        $part   = '';
        if (!$escape && $match[2] == '#') {
            $part = \array_shift($string);
        }
        else {
            $part = $match[2];
        }
        $part    = \stripslashes($match[1]) . $part;
        $mask    = \substr_replace($mask, '', 0, \strlen($match[0]));
        $return .= $part;
    }
    return $return;
}
