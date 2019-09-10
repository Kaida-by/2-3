<?php

namespace App;

use App\Exceptions\E404Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
    protected $view;

    protected $viewEngine = 'php';

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../template');
        $this->twig = new Environment($loader);
        if ($this->viewEngine === 'php') {
            $this->view = new View();
        } elseif ($this->viewEngine === 'twig') {
            $this->view = new ViewTwig();
        } else {
            throw new E404Exception('Ошибка 404 - не найден или некорректен файл viewEngine');
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
