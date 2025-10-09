<?php

namespace ZeusTest\Base;

use PHPUnit\Framework\TestCase;

/**
 * 
 * @author Rafael M. Salvioni
 */
class StringTest extends TestCase
{
    /**
     * @test
     */
    public function substrRemoveTest()
    {
        $string = __FUNCTION__;
        $this->assertTrue(substr_remove($string, 2) == 'bstrRemoveTest' && $string == 'su');
        
        $string = __FUNCTION__;
        $this->assertTrue(substr_remove($string, 0, 3) == 'sub' && $string == 'strRemoveTest');
        
        $string = __FUNCTION__;
        $this->assertTrue(substr_remove($string, 3, 4) == 'strR' && $string == 'subemoveTest');
        
        $string = __FUNCTION__;
        $this->assertTrue(substr_remove($string, -3) == 'est' && $string == 'substrRemoveT');
        
        $string = __FUNCTION__;
        $this->assertTrue(substr_remove($string, 5, -2) == 'rRemoveTe' && $string == 'substst');
        
        $string = __FUNCTION__;
        $this->assertTrue(substr_remove($string, -3, -2) == 'e' && $string == 'substrRemoveTst');
    }
    
    /**
     * @test
     */
    public function maskTest()
    {
        $this->assertEquals('123.456.789-00', mask('###.###.###-##', '12345678900'));
        $this->assertEquals('123.456.78#9-00', mask('###.###.##\##-##', '12345678900'));
        $this->assertEquals('12.345.678-90', mask('##.###.###-##', '12345678900'));
        $this->assertEquals('(11)98764-0987', mask('(##)#####-####', '11987640987'));
    }
    
    /**
     * @test
     */
    public function strPuCsvTest()
    {
        $line   = 'Campo1,Campo2,"Campo3,","Campo4\"",Campo5,';
        $fields = \str_getcsv($line);
        $csv    = \trim(\str_putcsv($fields));
        $this->assertEquals(6, \count($fields));
        $this->assertEquals($line, $csv);
    }
}
