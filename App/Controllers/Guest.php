<?php

namespace App\Controllers;

use App\Controller;

abstract class Guest extends Controller
{
    protected function access()
    {
        return true;
    }
}
