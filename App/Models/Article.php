<?php

namespace App\Models;

use App\Db;
use App\Model;

/**
 * @method Article findById($id)
 */

class Article extends Model
{
    use \App\WorkOnProperties;

    public const TABLE = 'news';

    public $title;

    public $content;

    public $author_id;

    protected $data;

    public static function findLast($how)
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC LIMIT ' . $how;
        $db = Db::getInstance();
        return $db->query($sql, [], static::class);
    }
}
