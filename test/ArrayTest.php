<?php

namespace ZeusTest\Base;

/**
 * 
 * @author Rafael M. Salvioni
 */
class ArrayTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function arrayAssocTest()
    {
        $array = \range(0, 10);
        $true  = !\array_is_assoc($array);
        unset($array[3]);
        $true  = $true && \array_is_assoc($array);
        $true  = $true && \array_is_assoc($GLOBALS);
        $this->assertTrue($true);
    }
    
    /**
     * @test
     */
    public function arrayQueueTest()
    {
        $array = \range(0, 9);
        $sum   = 0;
        $i     = 0;
        while (\array_queue($array, $val)) {
            $sum += $val;
            $i++;
            if ($i > 10) {
                $this->assertTrue(false);
                return;
            }
        }
        $this->assertEquals($sum, 45);
    }
    
    /**
     * @test
     */
    public function arrayLastTest()
    {
        $array = \range(0, 9);
        $this->assertTrue(
            \array_last($array) === 9 &&
            \array_last([]) === null &&
            \count($array) == 10
        );
    }
}
