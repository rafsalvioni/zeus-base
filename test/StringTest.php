<?php

namespace ZeusTest\Base;

/**
 * 
 * @author Rafael M. Salvioni
 */
class StringTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function substrRemoveTest()
    {
        $string = __FUNCTION__;
        $this->assertTrue(\substr_remove($string, 2) == 'bstrRemoveTest' && $string == 'su');
        
        $string = __FUNCTION__;
        $this->assertTrue(\substr_remove($string, 0, 3) == 'sub' && $string == 'strRemoveTest');
        
        $string = __FUNCTION__;
        $this->assertTrue(\substr_remove($string, 3, 4) == 'strR' && $string == 'subemoveTest');
        
        $string = __FUNCTION__;
        $this->assertTrue(\substr_remove($string, -3) == 'est' && $string == 'substrRemoveT');
        
        $string = __FUNCTION__;
        $this->assertTrue(\substr_remove($string, 5, -2) == 'rRemoveTe' && $string == 'substst');
        
        $string = __FUNCTION__;
        $this->assertTrue(\substr_remove($string, -3, -2) == 'e' && $string == 'substrRemoveTst');
    }
}
