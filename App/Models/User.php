<?php

namespace App\Models;

use App\Db;
use App\Model;

class User extends Model
{
    public const TABLE = 'users';

    public $password;

    public $name;

    public static function findByLogin($login)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE name=:name';
        $result = $db->query($sql, [':name' => $login], static::class);
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public static function functionsTable()
    {
        return [
            'username' => function(User $model) {
                return $model->name;
            }
        ];
    }
}
