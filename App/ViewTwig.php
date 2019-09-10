<?php

namespace App;

use App\Models\ViewInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewTwig implements ViewInterface
{
    use MagicTrait;

    public function render($name)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../template');
        $twig = new Environment($loader);
        return $twig->render($name, $this->data);
    }

    public function display($template)
    {
        echo $this->render($template);
    }
}
