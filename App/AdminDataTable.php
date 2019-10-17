<?php

namespace App;

class AdminDataTable
{
    protected $models = [];

    protected $functions = [];

    public function __construct($models, $functions)
    {
        $this->models = $models;
        $this->functions = $functions;
    }

    public function render()
    {
        $table = '<table border="1"><th></th>';
        foreach ($this->functions as $key => $func) {
            $table .= '<th>' . $key . '</th>';
        }
        foreach ($this->models as $key2 => $model) {
            $table .= '<tr><td>' . $key2 . '</td>';
            foreach ($this->functions as $func2) {
                $table .= '<td>' . $func2($model) . '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</table>';
        return $table;
    }
}
