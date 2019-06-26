<?php

namespace App;

use App\Models\Author;

trait WorkOnProperties
{
    protected $data;

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

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

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
}
