<?php

namespace App\Models;

interface ViewInterface
{
    public function display($template);

    public function render($template);
}
