<?php

namespace ZeusTest\Base;

use PHPUnit\Framework\TestCase;

/**
 * 
 * @author Rafael M. Salvioni
 */
class ArrayTest extends TestCase
{
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
