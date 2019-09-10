<?php

namespace App;

abstract class Controller
{
    protected $view;

    protected  $viewEngine;

    public function __construct()
    {
        if ($this->viewEngine === 'php') {
            $this->view = new View();
        } elseif ($this->viewEngine === 'twig') {
            $this->view = new ViewTwig();
        }
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
