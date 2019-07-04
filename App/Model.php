<?php

namespace App;

abstract class Model
{
    public const TABLE = '';

    protected $id;

    /**
     * @return int Возвращает защищенное свойство id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array Возвращяет все записи
     */
    public static function findAll()
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::TABLE;
        return $db->query($sql, [], static::class);
    }

    /**
     * @param int $id
     * @return bool|array Возвращает либо false, либо определенную запись
     */
    public static function findById($id)
    {
        $db = Db::getInstance();
        $sql = 'SELECT * FROM ' . static::TABLE . ' WHERE id=:id';
        $result = $db->query($sql, [':id' => $id], static::class);
        if ($result) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' WHERE :id=id';
        $db = Db::getInstance();
        $db->execute($sql, [':id' => $this->id]);
    }

    public function save()
    {
        if (!empty($this->id)) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    protected function insert()
    {
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' == $name) {
                continue;
        }
            $cols[] = $name;
            $data[':' . $name] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE . '
            (' . implode(',', $cols) . ') 
        VALUES 
            (' . implode(',', array_keys($data)) . ')';
        $db = Db::getInstance();
        $db->execute($sql, $data);
        $this->id = $db->getLastId();
    }

    protected function update()
    {
        $fields = get_object_vars($this);
        $cols = [];
        $data = [];

        foreach ($fields as $name => $value) {
            if ('id' == $name) {
                continue;
            }
            $cols[$name . '=:' . $name] = $value;
            $data[':' . $name] = $value;
        }

        $sql = 'UPDATE ' . static::TABLE .
            ' SET ' . implode(',', array_keys($cols)) .
            ' WHERE id=:id';
        $data[':id'] = $this->id;
        $db = Db::getInstance();
        $db->execute($sql, $data);
    }
}
