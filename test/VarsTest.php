<?php

namespace ZeusTest\Base;

/**
 * 
 * @author Rafael M. Salvioni
 */
class VarsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function coalesceTest()
    {
        $this->assertTrue(
                \coalesce(null, '') === '' &&
                \coalesce('', 0) === '' &&
                \coalesce(null, 0) === 0 &&
                \coalesce(null, false) === false
        );
    }
    
    /**
     * @test
     */
    public function dumpTest()
    {
        if (!\extension_loaded('xdebug')) {
            $values = [3, 4.6, true, false, null, __CLASS__, \STDIN, \range(0, 5), new self()];
            $val    = $values[\array_rand($values)];
            \var_dump($val);
            $this->expectOutputString(\dump($val));
        }
        else {
            $this->assertTrue(true);
        }
    }
}
