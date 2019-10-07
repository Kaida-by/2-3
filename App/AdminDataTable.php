<?php

namespace App;

class AdminDataTable
{
    protected $strings = [];

    protected $columns = [];

    public function __construct($articles, $functions)
    {
        $this->articles = $articles;

        $this->functions = $functions;
    }

    public function render()
    {

    }
}
