<?php

namespace Williamtome\App\Database;

class Connection
{
    private static $connection;

    public static function connect(): \PDO
    {
        if (!self::$connection) {
            self::$connection = new \PDO(
                'mysql:host=mysql;dbname=zenitech',
                'zenitech',
                'zenitech'
            );

            self::$connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$connection->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
        }

        return self::$connection;
    }
}
