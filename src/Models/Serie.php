<?php

namespace Lukelt\Api\Models;

use PDO;

class Serie {

    private string $table = 'serie';

    public function get(int $id)
    {
        $connection = new PDO('sqlite: ./../db.sqlite');

        $sql = $connection->prepare("SELECT * FROM {$this->table} WHERE id = :id;");
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}