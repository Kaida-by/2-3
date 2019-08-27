<?php

namespace App;

class Logger
{
    public function setLog($message, $file, $line)
    {
        $log = date('Y-m-d H:i:s') .
            "\r\n" .
            print_r($message, true) .
            "\r\n" .
            'В файле: ' .
            $file .
            "\r\n" .
            'На строке: ' .
            $line .
            "\r\n" .
            '================================================================';
        file_put_contents(__DIR__ . '/../log/errors.txt', $log . PHP_EOL, FILE_APPEND);
    }
}
