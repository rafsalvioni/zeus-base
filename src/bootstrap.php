<?php

foreach ((array)\glob(__DIR__ . DIRECTORY_SEPARATOR . '_*.php') as $file) {
    require $file;
}

/**
 * Defines a default error handler to convert PHP Errors in ErrorException
 * objects.
 * 
 * Do not consider error_reporting for do this.
 * 
 */
$h = set_error_handler(function($errno, $errstr, $errfile, $errline)
{
    if (ini_get('track_errors')) {
        global $php_errormsg;
        $php_errormsg = $errstr;
    }
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});
if ($h) {
    restore_error_handler();
}

/**
 * Defines a default exception handler.
 * 
 */
$h = set_exception_handler(function(Exception $e)
{
    $exClass  = get_class($e);
    $loggable = !($e instanceof ErrorException)
              || ((error_reporting() & $e->getSeverity()) != 0);

    // Sends the exception to PHP's logger. If a ErrorException, consider
    // error_reporting directive
    try {
        if ($loggable && ini_get('log_errors')) {
            $log = sprintf('[%s](%s):"%s" in %s:%d', date('r'), $exClass, $e->getMessage(), $e->getFile(), $e->getLine());
            error_log($log, 0);
            unset($log);
        }
    }
    catch (ErrorException $ex) {
    }

    // If "display_errors" is on, show a full message
    if (!PHP_ON_WEB || ini_get('display_errors')) {
        $message = sprintf(
            "PHP %s\n\tUncaught exception \"%s\" with message \"%s\"\r\n\t\tin file \"%s\":%d\r\n\tStack trace:\r\n\t\t%s",
            PHP_VERSION,
            $exClass,
            $e->getMessage(),
            realpath($e->getFile()),
            $e->getLine(),
            preg_replace('/\r?\n/', "\r\n\t\t", $e->getTraceAsString())
        );
    }
    // Otherwise, a short message without dangerous information
    else {
        $message = "\tUncaught exception \"$exClass\""
                . "\r\n\t(more information is unavailable for security"
                . " reasons... Check system's error log)";
    }
    $message = \str_replace("\t", '    ', $message);

    // If html_errors is on, format the message
    if (PHP_ON_WEB) {
        $headers = headers_sent();
        if (ini_get('html_errors')) {
            $message = '
<div style="border: solid 1px #FF0000; background-color: #FFEFEF; display: block; width: 100%; font: bold 15 Verdana,Arial">
<pre>' . $message . '</pre></div>';
        }
        else if ($headers) {
            header('Content-Type: text/plain');
        }
        if ($headers) {
            header('HTTP/1.1 500');
        }
    }
    else {
        $message = \str_repeat('=', 20) . "\r\n$message\r\n" . \str_repeat('=', 20);
    }
    
    echo $message;
});
if ($h) {
    restore_exception_handler();
}

echo $a[0];