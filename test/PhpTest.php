<?php

namespace ZeusTest\Base;

use Zeus\Base\Php;

/**
 * 
 * @author Rafael M. Salvioni
 */
class PhpTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constsTest()
    {
        $this->assertTrue(
            PHP\X64 === ((1 << 32) != 1) &&
            PHP\ON_WEB === isset($_SERVER['REMOTE_ADDR'])
        );
    }
    
    /**
     * @test
     */
    public function obActiveTest()
    {
        \ob_start();
        $init = \ob_get_level();
        do {
            $level  = \ob_get_level();
            $active = Php\ob_active() ^ $level > 0;
            if ($active) {
                $this->assertTrue(false);
                return;
            }
            if ($level == 0) {
                break;
            }
            \ob_end_flush();
        } while ($level > $init);
        
        $this->assertTrue(true);
    }
    
    /**
     * @test
     * @depends obActiveTest
     */
    public function obGetEndTest()
    {
        \ob_start();
        $n = \ob_get_level();
        echo __CLASS__;
        $this->assertTrue(
            PHP\ob_get_end() === __CLASS__ &&
            $n > \ob_get_level()
        );
    }
}
