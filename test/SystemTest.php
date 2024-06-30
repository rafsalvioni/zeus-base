<?php

namespace ZeusTest\Base;

use PHPUnit\Framework\TestCase;

/**
 * 
 * @author Rafael M. Salvioni
 */
class SystemTest extends TestCase
{
    /**
     * @test
     */
    public function constsTest()
    {
        $this->assertTrue(SYS_OS_WIN === (stripos(PHP_OS, 'win') === 0));
        $this->assertTrue(SYS_OS_NIX === (PHP_EOL == "\n"));
        $this->assertTrue(SYS_OS_MAC === (PHP_EOL == "\r"));
        $this->assertTrue(SYS_TEMP_DIR === (sys_get_temp_dir() . DIRECTORY_SEPARATOR));
        $this->assertTrue(SYS_LITTLE_ENDIAN === (pack('S', 0xFF) === pack('v', 0xFF)));
    }
}
