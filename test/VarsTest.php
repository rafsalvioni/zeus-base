<?php

namespace ZeusTest\Base;

use Zeus\Base\Vars;

/**
 * 
 * @author Rafael M. Salvioni
 */
class VarsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function dumpTest()
    {
        if (!\extension_loaded('xdebug')) {
            $values = [3, 4.6, true, false, null, __CLASS__, \STDIN, \range(0, 5), new self()];
            $val    = $values[\array_rand($values)];
            \var_dump($val);
            $this->expectOutputString(Vars\dump($val));
        }
        else {
            $this->assertTrue(true);
        }
    }
}
