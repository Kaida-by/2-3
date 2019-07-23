<?php

namespace App;

class Config
{
    public $data = [];

    protected static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function __construct()
    {
        $this->data = include __DIR__ . '/../config.php';
    }

    protected function __clone()
    {
    }
}
