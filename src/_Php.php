<?php
/**
 * Additional features to own PHP.
 *
 * @author Rafael M. Salvioni
 */

namespace Zeus\Base\Php;

/**
 * Reports if the script is executing under a WebServer.
 * 
 * @const bool
 */
\define(__NAMESPACE__ . '\\ON_WEB',
    isset($_SERVER['REMOTE_ADDR'])
    && isset($_SERVER['REQUEST_METHOD'])
);

/**
 * Reports if a PHP was compiled using x64 architecture.
 * 
 * @const bool
 */
\define(__NAMESPACE__ . '\\X64', \PHP_INT_SIZE == 8);

/**
 * Informs if a any output buffer active.
 * 
 * @return bool
 */
function ob_active(): bool
{
    return \ob_get_level() > 0;
}

/**
 * Returns the output buffer contents and finalizes it.
 * 
 * @return string
 */
function ob_get_end(): string
{
    $return = \ob_get_contents();
    \ob_end_clean();
    return $return;
}
