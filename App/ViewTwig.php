<?php

namespace App;

class ViewTwig extends Controller implements ViewInterface
{
    use MagicTrait;

    public function render($template)
    {
        return $this->twig->render($template, $this->data);
    }

    public function display($template)
    {
        echo $this->render($template);
    }

    protected function access()
    {
    }
}
