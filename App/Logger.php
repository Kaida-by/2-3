<?php

namespace App;

class Logger
{
    public function setLog($message)
    {
        $log = date('Y-m-d H:i:s') . ' ' . print_r($message, true);
        file_put_contents(__DIR__ . '/../log/errors.txt', $log . PHP_EOL, FILE_APPEND);
    }
}
