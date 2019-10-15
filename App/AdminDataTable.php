<?php

namespace App;

class AdminDataTable
{
    protected $articles = [];

    protected $functions = [];

    public function __construct($articles, $functions)
    {
        $this->articles = $articles;
        $this->functions = $functions;
    }

    public function render()
    {
        $table = '<table border="1"><th></th>';
        foreach ($this->functions as $key => $func) {
            $table .= '<th>' . $key . '</th>';
        }
        foreach ($this->articles as $key2 => $article) {
            $table .= '<tr><td>' . $key2 . '</td>';
            foreach ($this->functions as $func2) {
                $table .= '<td>' . $func2($article) . '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</table>';
        return $table;
    }
}
