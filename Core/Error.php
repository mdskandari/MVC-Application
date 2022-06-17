<?php

namespace Core;

use \Core\View;

class Error
{
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() != 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    public static function exceptionHandler($exception)
    {
        $code = $exception->getCode();

        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if (true) {
            echo "<h1>".get_class($exception)."</h1>";
            echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
            echo "<p>Message: '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Throw in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        } else {
            $log = dirname(__DIR__) . '/storage/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "'\n";
            $message .= "Message: '" . $exception->getMessage() . "'\n";
            $message .= "Stack trace:" . $exception->getTraceAsString() . "\n";
            $message .= "Throw in '" . $exception->getFile() . "' on line " . $exception->getLine() . "\n";

            error_log($message);
            echo view::renderTemplate("errors.{$code}");
        }
    }
}