<?php
/**
 * Additional functions to get and manipulate information about Server.
 *
 * @author Rafael M. Salvioni
 */

/**
 * Reports if OS is Windows.
 * 
 * @var bool
 */
define('SYS_OS_WIN', stripos(PHP_OS, 'win') === 0);
/**
 * Reports if OS is derived from Unix.
 * 
 * @var bool
 */
define('SYS_OS_NIX', PHP_EOL == "\n");
/**
 * Reports if OS is a MacOS.
 * 
 * @var bool
 */
define('SYS_OS_MAC', PHP_EOL == "\r");
/**
 * Stores the default temp directory.
 * 
 * @var string
 */
define('SYS_TEMP_DIR', sys_get_temp_dir() . DIRECTORY_SEPARATOR);
/**
 * Reports if the processor architeture uses little endian order.
 * 
 * @var bool
 */
define('SYS_LITTLE_ENDIAN', pack('S', 0xFF) === pack('v', 0xFF));
