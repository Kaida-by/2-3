<?php

namespace App;

use App\Exceptions\DbException;

class Db
{
    protected $dbh;

    protected static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $sql
     * @param array $data
     * @param string $class
     * @return array
     * @throws DbException
     */
    public function query($sql, $data = [], $class = \stdClass::class)
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (!$result) {
            throw new DbException('Неверный запрос к БД');
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    /**
     * @param $sql
     * @param array $data
     * @param string $class
     * @throws DbException
     * @return \Generator
     */
    public function queryEach($sql, $data = [], $class = \stdClass::class)
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (!$result) {
            throw new DbException('Неверный запрос к БД');
        }
        while ($article = $sth->fetch()) {
            yield $article;
        }
    }

    public function execute($query, $params=[])
    {
        $sth = $this->dbh->prepare($query);
        return $sth->execute($params);
    }

    public function getLastId()
    {
        return $this->dbh->lastInsertId();
    }

    /**
     * Db constructor.
     * @throws DbException
     */
    protected function __construct()
    {
        $config = Config::getInstance();
        try {
            $this->dbh = new \PDO(
                'mysql:=' . $config->data['db']['host'] . ';dbname=' . $config->data['db']['dbname'],
                $config->data['db']['user'],
                $config->data['db']['password']
            );
        } catch (\PDOException $error) {
            throw new DbException('Нет соединения с БД');
        }
    }

    protected function __clone()
    {
    }
}
