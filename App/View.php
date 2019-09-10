<?php

namespace App;

class View implements \Countable, \Iterator, ViewInterface
{
    use MagicTrait;

    public function render($template)
    {
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function display($template)
    {
        echo $this->render($template);
    }

    public function count()
    {
        return count($this->data);
    }

    /**
     * Возвращаем значение текущего элемента
     */
    public function current()
    {
        return current($this->data);
    }

    /**
     * Сдвигаем указатель на следующий элемент
     */
    public function next()
    {
        next($this->data);
    }

    /**
     * Возвращаем ключ текущего элемента
     */
    public function key()
    {
        return key($this->data);
    }

    /**
     * Проверяем, чтобы указатель не вышел за границы
     */
    public function valid()
    {
        return null !== key($this->data);
    }

    /**
     * Ставим указатель на первый элемент
     */
    public function rewind()
    {
        reset($this->data);
    }
}
