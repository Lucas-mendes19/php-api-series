<?php

namespace Lukelt\Api\Infrastructure\Persistence;

use PDO;

class Connection
{
    private static PDO $instance;
    private static string $path = './../db.sqlite';

    public static function instance(): PDO
    {
        if (!isset(self::$instance))
            self::$instance = new PDO('sqlite: ' . self::$path);

        return self::$instance;
    }
}