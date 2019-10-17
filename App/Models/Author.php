<?php

namespace App\Models;

use App\Model;
use App\AdminDataTable;

class Author extends Model
{
    public const TABLE = 'authors';

    public $name;

    public static function functionsTable()
    {
        return
            [
                'author' => function(Author $model) {
                    return $model->name;
                }
            ];
    }
}
