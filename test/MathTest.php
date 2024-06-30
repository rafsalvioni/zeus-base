<?php

namespace ZeusTest\Base;

use PHPUnit\Framework\TestCase;

/**
 * 
 * @author Rafael M. Salvioni
 */
class MathTest extends TestCase
{
    /**
     * @test
     */
    public function ceilTest()
    {
        $this->assertSame(2.0, ceil_p(1.3, 0));
        $this->assertSame(2, (int)ceil_p(1.3, 0));
        $this->assertSame(1.65, ceil_p(1.642, 2));
        $this->assertSame(1.6546, ceil_p(1.654567, 4));
    }
    
    /**
     * @test
     */
    public function floorTest()
    {
        $this->assertSame(1.0, floor_p(1.3, 0));
        $this->assertSame(1, (int)floor_p(1.3, 0));
        $this->assertSame(1.64, floor_p(1.645, 2));
        $this->assertSame(1.6545, floor_p(1.654567, 4));
        //$this->assertSame(2.05, floor_p(2.05, 2));
    }
    
    /**
     * @test
     */
    public function precisionTest()
    {
        $this->assertSame(0, get_precision(4));
        $this->assertSame(1, get_precision(2.50));
        $this->assertSame(4, get_precision(2.5567));
        $this->assertSame(2, get_precision(2.05));
        $this->assertSame(1, get_precision(-2.50));
        $this->assertSame(9, get_precision(451.028734664));
    }
    
    /**
     * @test
     */
    public function isMultipleTest()
    {
        $this->assertTrue(is_multiple(4, 2));
        $this->assertTrue(is_multiple(3, 3));
        $this->assertTrue(is_multiple(256, 2));
        $this->assertTrue(!is_multiple(256, 5));
    }
    
    /**
     * @test
     * @depends precisionTest
     */
    public function maybeTest()
    {
        $this->assertTrue(maybe(1));
        $this->assertTrue(maybe(1.01));
        $this->assertFalse(maybe(0));
        $this->assertFalse(maybe(-0.2));
        
        $count = 0;
        $tests = 100;
        $prob  = .357;
        $test  = intval($tests * $prob);
        
        for ($i = 0; $i < $tests; $i++) {
            if (maybe($prob)) {
                $count++;
            }
        }
        
        $min = $test * .7;
        $this->assertTrue($count >= $min, "$count / $test");
    }
    
    /**
     * @test
     */
    public function interpolateTest()
    {
        $this->assertEquals(7.5, interpolate(6, 9, 8, 12, 5));
    }
    
    /**
     * @test
     */
    public function avgTest()
    {
        $this->assertEquals(2660, avgw(1100, 5, 2000, 16, 5500, 3, 12500, 1));
        $this->assertEquals(avg(1100, 2000, 5500, 12500), avgw(1100, 15, 2000, 15, 5500, 15, 12500, 15));
    }
    
    /**
     * @test
     */
    public function limitTest()
    {
        $min  = -10;
        $max  = 100;
        $edge = random_int($min, $max);
        $test = limit_test($min, $max, function ($test) use ($edge) {
            return $test < $edge;
        }, 1);
        
        $this->assertEquals($edge, \round($test));
    }
}
