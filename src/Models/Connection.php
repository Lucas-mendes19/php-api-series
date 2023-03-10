<?php

namespace Lukelt\Api\Models;

use PDO;

class Connection
{
    private readonly string $path;
    public readonly PDO $link;

    public function __construct()
    {
        $this->path = './../db.sqlite';
        $this->connect();
    }

    public function connect()
    {
        $this->link = new PDO('sqlite: ' . $this->path);
    }
}