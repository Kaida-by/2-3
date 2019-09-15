<?php

namespace App;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewTwig implements ViewInterface
{
    use MagicTrait;

    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../template');
        $this->twig = new Environment($loader);
    }

    public function render($template)
    {
        return $this->twig->render($template, $this->data);
    }

    public function display($template)
    {
        echo $this->render($template);
    }
}
