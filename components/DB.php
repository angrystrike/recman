<?php

namespace components;

use PDO;

abstract class DB
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = self::getConnection();
    }

    public static function getConnection()
    {
        $params = include(ROOT . '/config/params.php');

        $connectionString = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($connectionString, $params['user'], $params['password']);

        return $db;
    }

    abstract public function all();
    abstract public function count();
    abstract public function findOneById($id);

}