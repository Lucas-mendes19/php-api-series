<?php

$path = __DIR__ . "/db.sqlite";
$pdo = new PDO('sqlite:' . $path);   

$pdo->exec("CREATE TABLE serie ( 
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    season INTEGER,
    episode INTEGER
)");