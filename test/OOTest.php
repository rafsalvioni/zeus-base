<?php

namespace ZeusTest\Base;

use PHPUnit\Framework\TestCase;

/**
 * 
 * @author Rafael M. Salvioni
 */
class OOTest extends TestCase
{
    private $objTest;
    
    /**
     * 
     * @return void
     */
    public function setUp(): void
    {
        $this->objTest = new class
        {
            public $test;
            private $test2;
            
            public function setTest2($val) {$this->test2 = $val;}
            
            public function set_Test2($val) {$this->test2 = $val;}
            
            public function getTest2() {return $this->test2;}
            
            public function get_Test2() {return $this->test2;}
        };
    }
    
    /**
     * @test
     */
    public function objectSetterTest()
    {
        $rand = mt_rand(1, 1000);
        object_setter($this->objTest, 'test', $rand);
        object_setter($this->objTest, 'test2', $rand);
        object_setter($this->objTest, 'test2', $rand, 'set_%s');
        $this->assertSame($rand, $this->objTest->test);
        $this->assertSame($rand, $this->objTest->getTest2());
    }
    
    /**
     * @test
     */
    public function objectGetterTest()
    {
        $rand1 = object_getter($this->objTest, 'test');
        $rand2 = object_getter($this->objTest, 'test2');
        $rand3 = object_getter($this->objTest, 'test2', 'get_%s');
        $this->assertSame($rand1, $rand2);
        $this->assertSame($rand2, $rand3);
    }
}
