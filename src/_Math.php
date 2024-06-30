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
    return ($num % $base) == 0;
}

/**
 * Does a random decision using given propability factor
 * 
 * Examples:
 * - maybe(0.1) => ~1 true each 10 function calls
 * - maybe(0.8) => ~8 true each 10 function calls
 * - maybe(0.554) => ~554 true each 1000 function calls
 * - maybe(>=1) => Always true
 * - maybe(<=0) => Always false
 * 
 * @param float $prob Probability factor
 * @return bool
 */
function maybe(float $prob = 0.1): bool
{
    if ($prob >= 1) {
        $bool = true;
    }
    else if ($prob <= 0) {
        $bool = false;
    }
    else {
        $n     = get_precision($prob);
        $max   = pow(10, $n);
        $prob *= $max;
        $rand  = mt_rand(1, $max);
        $bool  = $rand <= $prob;
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
            $d = ($y2 - $y1) / ($x2 - $x1);
            $y = is_finite($d) ? $y1 + ($x - $x1) * $d : $y1;
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
 * Searchs the limit value in a range where given condition changes
 * from false to true
 * 
 * $test should returns a boolean, where:
 * o true:  Test continues with greatest values
 * o false: Test continues with lowest values
 * 
 * @param int $min Min value
 * @param int $max Max value
 * @param \Closure $test Function to test
 * @param int $p Precision
 * @return int
 */
function limit_test(int $min, int $max, \Closure $test, int $p = 0): float
{
    $b = pow(10, -$p);
    while ($min < $max) {
        $mid = round(avg($min, $max), $p);
        if ($test($mid)) {
            $min = $mid + $b;
        }
        else {
            $max = $mid - $b;
        }
    }
    return $min;
}
