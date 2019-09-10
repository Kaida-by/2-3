<?php

namespace App;

interface ViewInterface
{
    public function display($template);

    public function render($template);
}
