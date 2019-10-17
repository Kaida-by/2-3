<?php

namespace App\Models;

use App\Db;
use App\Model;
use App\MagicTrait;

/**
 * @method Article findById($id)
 *
 * @property Author $author
 */
class Article extends Model
{
    use MagicTrait;

    public const TABLE = 'news';

    public $title;

    public $content;

    public $author_id;

    protected $schema = [
        'title' => ['type' => 'string', 'minLength' => 5, 'maxLength' => 50],
        'content' => ['type' => 'string', 'minLength' => 5, 'maxLength' => 200],
        'author_id' => ['type' => 'integer']
    ];

    public function __get($name)
    {
        if ($name == 'author') {
            if ($this->author_id == null) {
                return null;
            } else {
                return Author::findById($this->author_id);
            }
        } else {
            return $this->data[$name];
        }
    }

    public static function functionsTable()
    {
        return [
            'title' => function(Article $model) {
                return $model->title;
            },
            'trimmedText' => function(Article $model) {
                return substr($model->content, 0, 3);
            },
            'authors_id' => function(Article $model) {
                return $model->author_id;
            }
        ];
    }

    /**
     * @param int $how Кол-во последних записей
     * @return array Возвращает последнюю запись
     */
    public static function findLast($how)
    {
        $sql = 'SELECT * FROM ' . static::TABLE . ' ORDER BY id DESC LIMIT ' . $how;
        $db = Db::getInstance();
        return $db->query($sql, [], static::class);
    }
}
