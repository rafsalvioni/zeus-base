<?php

/**
 * Round fractions to UP using a precision
 * 
 * @param int|float $num Number
 * @param int $precision Precision
 * @return float
 */
function ceil_p(int|float $num, int $precision): float
{
    if ($precision < 1) {
        return ceil($num);
    }
    $power = pow(10.0, $precision);
    return ceil($num * $power) / $power;
}

/**
 * Round fractions to DOWN using a precision
 * 
 * @param int|float $num Number
 * @param int $precision Precision
 * @return float
 */
function floor_p(int|float $num, int $precision): float
{
    if ($precision < 1) {
        return floor($num);
    }
    $power = pow(10.0, $precision);
    return intval($num * $power) / $power;
}

/**
 * Returns the precision of given number
 * 
 * Returns 0 to integers
 * 
 * @param int|float $num Number
 * @return int
 */
function get_precision(int|float $num): int
{
    $str = strval($num);
    if (preg_match('/\.(\d+)$/', $str, $match)) {
        return strlen($match[1]);
    }
    return 0;
}

/**
 * Checks if a number is multiple of another
 * 
 * (Encapsulates MOD operator test)
 * 
 * @param int|float $num Number
 * @param int $base Base
 * @return bool
 */
function is_multiple(int|float $num, int $base): bool
{
    return \fmod($num, $base) == 0;
}

/**
 * Check if a number is between 2 others
 * 
 * @param float|int $num Num tested
 * @param float|int $min Min num
 * @param float|int $max Max num
 * @param bool $inclusive Is inclusive?
 * @return bool
 */
function is_between(float|int $num, float|int $min, float|int $max, bool $inclusive = true): bool
{
    if ($inclusive) {
        return $num >= $min && $num <= $max;
    }
    return $num > $min && $num < $max;
}

/**
 * Does a random decision using given propability factor
 * 
 * Examples:
 * - maybe(10)    => ~1 true each 10 function calls
 * - maybe(80)    => ~8 true each 10 function calls
 * - maybe(>=100) => Always true
 * - maybe(<=0)   => Always false
 * 
 * @param int $prob Probability factor
 * @return bool
 */
function maybe(int $prob = 10): bool
{
    if ($prob >= 100) {
        $bool = true;
    }
    else if ($prob <= 0) {
        $bool = false;
    }
    else {
        $rand = mt_rand(1, 100);
        $bool = $rand <= $prob;
    }
    return $bool;
}

/**
 * Does a linear interpolation
 * 
 * @param float $x1 X1
 * @param float $y1 Y1
 * @param float $x2 X2
 * @param float $y2 Y2
 * @param float $x  X
 * @return float
 */
function interpolate(float $x1, float $y1, float $x2, float $y2, float $x): float
{
    switch ($x) {
        case $x1:
            return $y1;
        case $x2:
            return $y2;
        default:
            $d = \fdiv($y2 - $y1, $x2 - $x1);
            $y = \is_finite($d) ? $y1 + ($x - $x1) * $d : $y1;
            return $y;
    }
}

/**
 * Does a simple arithmetic average
 * 
 * @param float|int $values Values
 * @return float
 */
function avg(float|int ...$values): float
{
    return array_sum($values) / count($values);
}

/**
 * Does a weighted arithmetic average
 * 
 * @param float|int $values Value/Weight pairs
 * @return float
 */
function avgw(float|int ...$values): float
{
    $i    = 0;
    $sumP = 0;
    $sumW = 0;

    while (isset($values[$i])) {
        $v =& $values[$i++];
        $w =& $values[$i++] ?? 0;
        $sumP += $v * $w;
        $sumW += $w;
    }
    return $sumP / $sumW;
}

/**
 * Searchs, using binary search, the greatest value that satisfies
 * given function.
 * 
 * If no value satisfies, returns $min - 1
 * 
 * $test should returns a boolean, where:
 * o true:  Test continues with greatest values
 * o false: Test continues with lowest values
 * 
 * $max can be null. In this case, it will be defined testing values with $test
 * using exponecial search (ie 1, 2, 4, 8, 16...). For this, more iterations
 * its necessary. So, is better to given a pre calculated value when possible.
 * 
 * @param \Closure $test Function to test
 * @param int $min Min value
 * @param int|null $max Max value If null, will be defined
 * @return int
 */
function limit_test(\Closure $test, int $min = 0, ?int $max = null): int
{
    if ($max === null) { // Max doenst given?
        $max = \max(1, $min + 1);
        while ($test($max)) {
            $max *= 2;
        }
    }
    
    $res = $min - 1;
    while ($min <= $max) {
        $mid = (int)avg($min, $max);
        if ($test($mid)) {
            $res = $mid;
            $min = $mid + 1;
        }
        else {
            $max = $mid - 1;
        }
    }
    return $res;
}
