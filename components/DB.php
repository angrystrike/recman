<?php

namespace components;

use PDO;

/**
 * This is a base class for Model
 * I would add here abstract methods for all models
 */
abstract class DB
{
    protected static $db;
    protected $table;

    public function __construct()
    {
        // I avoid creating separate connections for each call
        if (self::$db === null) {
            self::$db = self::getConnection();
        }
    }

    public static function getConnection()
    {
        $params = include(ROOT . '/config/params.php');
        $connectionString = "mysql:host={$params['host']};dbname={$params['dbname']}";

        return new PDO($connectionString, $params['user'], $params['password']);
    }
}