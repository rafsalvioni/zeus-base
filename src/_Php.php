<?php
/**
 * Additional features to own PHP.
 *
 * @author Rafael M. Salvioni
 */

/**
 * Reports if the script is executing under a WebServer.
 * 
 * @const bool
 */
define('PHP_ON_WEB',
    isset($_SERVER['REMOTE_ADDR'])
    && isset($_SERVER['REQUEST_METHOD'])
);

/**
 * Reports if a PHP was compiled using x64 architecture.
 * 
 * @const bool
 */
define('PHP_X64', \is_int(\PHP_INT_MAX + 1));

/**
 * Informs if a any output buffer active.
 * 
 * @return bool
 */
function ob_active()
{
    return ob_get_level() > 0;
}

/**
 * Returns the output buffer contents and finalizes it.
 * 
 * @return string
 */
function ob_get_end()
{
    $return = ob_get_contents();
    ob_end_clean();
    return $return;
}
