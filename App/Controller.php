<?php

namespace App;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action)
    {
        if ($this->access()) {
            return $this->$action();
        } else {
            die('Доступ закрыт');
        }
    }

    abstract protected function access();
}
