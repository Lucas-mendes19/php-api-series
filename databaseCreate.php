<?php

$path = __DIR__ . "/db.sqlite";
$pdo = new PDO('sqlite:' . $path);   

$pdo->exec("CREATE TABLE serie ( 
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    season INTEGER,
    episode INTEGER
)");


// $pdo->exec("INSERT INTO serie (name, season, episode) VALUES ('The Last of Us', 1, 7);");