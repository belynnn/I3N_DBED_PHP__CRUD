<?php

abstract class Model
{
    public static $pdo;

    private static function connect()
    {
        if (self::$pdo == null) {
            self::$pdo = new PDO(
                'mysql:host=127.0.0.1;dbname=banque2;charset=utf8', // database info
                "root", // username
                ""  // password
            );
        }

        return self::$pdo;
    }

    protected static function execute($sql, $params = null)
    {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    protected static function lastInsertedID()
    {
        return self::connect()->lastInsertId();
    }
}
