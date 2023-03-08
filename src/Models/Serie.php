<?php

namespace Lukelt\Api\Models;

use Exception;
use PDO;

class Serie {

    private static string $table = 'serie';

    public static function select(int $id)
    {
        $connection = new PDO('sqlite: ./../db.sqlite');

        $stm = $connection->prepare("SELECT * FROM " . self::$table . " WHERE id = :id;");
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        $data = $stm->fetch(PDO::FETCH_ASSOC);
        if(!is_array($data))
            throw new Exception("Nenhuma serie encontrada!");

        return $data;
    }

    public static function all()
    {
        $connection = new PDO('sqlite: ./../db.sqlite');

        $stm = $connection->query("SELECT * FROM " . self::$table);

        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        if(!is_array($data))
            throw new Exception("Nenhuma serie encontrada!");

        return $data;
    }

    public static function insert($data)
    {
        $connection = new PDO('sqlite: ./../db.sqlite');

        $sql = "INSERT INTO " . self::$table . "(name, season, episode) VALUES (:name, :season, :episode)";
        $stm = $connection->prepare($sql);
        $stm->bindValue(':name', $data['name']);
        $stm->bindValue(':season', $data['season']);
        $stm->bindValue(':episode', $data['episode']);
        $stm->execute();

        if ($stm->rowCount() <= 0)
            throw new Exception("Ocorreu um error ao inserir a serie!");

        return "Serie inserida com sucesso!";
    }
}