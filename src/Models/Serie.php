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

        $date = $stm->fetch(PDO::FETCH_ASSOC);
        if(!is_array($date))
            throw new Exception("Nenhuma serie encontrada!");

        return $date;
    }

    public static function all()
    {
        $connection = new PDO('sqlite: ./../db.sqlite');

        $stm = $connection->query("SELECT * FROM " . self::$table);

        $date = $stm->fetchAll(PDO::FETCH_ASSOC);
        if(!is_array($date))
            throw new Exception("Nenhuma serie encontrada!");

        return $date;
    }
}