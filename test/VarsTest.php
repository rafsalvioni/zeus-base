<?php

namespace ZeusTest\Base;

use PHPUnit\Framework\TestCase;

/**
 * 
 * @author Rafael M. Salvioni
 */
class VarsTest extends TestCase
{
    /**
     * @test
     */
    public function coalesceTest()
    {
        $this->assertSame(coalesce(null, 0, true), 0);
        $this->assertSame(coalesce(null, false, true), false);
        $this->assertSame(coalesce(null, '', true), '');
    }
    
    /**
     * @test
     */
    public function dumpTest()
    {
        if (!\extension_loaded('xdebug')) {
            $values = [3, 4.6, true, false, null, __CLASS__, \STDIN, \range(0, 5)];
            $val    = $values[\array_rand($values)];
            \var_dump($val);
            $this->expectOutputString(\dump($val));
        }
        else {
            $this->assertTrue(true);
        }
    }
    
    /**
     * @test
     */
    public function isNumberTest()
    {
        $this->assertTrue(is_number(1));
        $this->assertTrue(is_number(1.7));
        $this->assertTrue(is_number(NAN));
        $this->assertTrue(!is_number('12'));
        $this->assertTrue(!is_number(null));
        $this->assertTrue(!is_number(true));
        $this->assertTrue(!is_number(false));
        $this->assertTrue(!is_number([]));
    }
    
    /**
     * @test
     */
    public function createInstanceTest()
    {
        $class    = __CLASS__;
        $instance = create_instance($class);
        $this->assertTrue($instance instanceof self);
    }
    
    /**
     * @test
     */
    public function gettypeoTest()
    {
        $this->assertEquals('boolean', gettypeo(true));
        $this->assertEquals('boolean', gettypeo(false));
        $this->assertEquals('integer', gettypeo(65));
        $this->assertEquals('double', gettypeo(65.98));
        $this->assertEquals('string', gettypeo('sgsdg'));
        $this->assertEquals('resource', gettypeo(STDIN));
        $this->assertEquals('object:' . __CLASS__, gettypeo($this));
    }
}
