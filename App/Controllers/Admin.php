<?php

namespace App\Controllers;

use App\Controller;

abstract class Admin extends Controller
{
    protected function access()
    {
        return false;
    }
}
