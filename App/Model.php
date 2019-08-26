<?php

namespace App;

use App\Exceptions\Errors;

abstract class Model
{
    public const TABLE = '';

    protected $id;

    protected $schema = [];

    /**
     * @param array $data
     * @throws Errors
     */
    public function fill(array $data)
    {
        $errors = new Errors;
        foreach ($data as $key => $value) {
            if (property_exists($this, $key) && $key !== 'id') {
                if ($this->schema[$key]['type'] === 'string' && !is_string($value)) {
                    $errors->add(new \Exception('Задан неверный тип в свойстве: ' . $key));
                }
                if (isset($this->schema[$key]['minLength']) && strlen($value) < $this->schema[$key]['minLength']) {
                    $errors->add(
                        new \Exception(
                            'Минимальное кол-во символов: ' . $this->schema[$key]['minLength'] . ' в свойстве: ' . $key
                        )
                    );
                }
                if (isset($this->schema[$key]['maxLength']) && strlen($value) >= $this->schema[$key]['maxLength']) {
                    $errors->add(
                        new \Exception(
                            'Превышено максимально кол-во символов:' . $this->schema[$key]['maxLength'] . ' в свойстве: ' . $key
                        )
                    );
                }
                if ($this->schema[$key]['type'] === 'integer' && !is_int($value)) {
                    $errors->add(new \Exception('Задан неверный тип в свойстве: ' . $key));
                }
            }
                $this->{$key} = $value;
        }
        if (!$errors->empty()) {
            throw $errors;
        }
    }

    /**
     * @return int Возвращает защищенное свойство id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     * @throws Exceptions\DbException
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
            if ('id' == $name || 'data' == $name || 'schema' == $name) {
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
            if ('id' == $name || 'data' == $name || 'schema' == $name) {
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
