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
            return $this->handle($action);
        } elseif (isset($_SESSION['user'])) {
            return $this->handle($action);
        } else {
            die('Доступ закрыт');
        }
    }

    abstract protected function handle($action);
}
