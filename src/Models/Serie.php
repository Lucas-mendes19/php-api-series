<?php

namespace Lukelt\Api\Models;

use Exception;
use PDO;

class Serie
{
    private readonly string $table;
    private readonly PDO $conn;

    public function __construct() {
        $this->table = 'serie';

        $connection = new Connection();
        $this->conn = $connection->link;
    }

    public function select(int $id): array
    {
        $stm = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id;");
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        $data = $stm->fetch(PDO::FETCH_ASSOC);
        if(!is_array($data))
            throw new Exception("Nenhuma serie encontrada!");

        return $data;
    }

    public function all(): array
    {
        $stm = $this->conn->query("SELECT * FROM {$this->table};");

        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        if(!is_array($data))
            throw new Exception("Nenhuma serie encontrada!");

        return $data;
    }

    public function insert($data): string
    {

        $sql = "INSERT INTO {$this->table} (name, season, episode) VALUES (:name, :season, :episode)";
        $stm = $this->conn->prepare($sql);
        $stm->bindValue(':name', $data['name']);
        $stm->bindValue(':season', $data['season']);
        $stm->bindValue(':episode', $data['episode']);
        $stm->execute();

        if ($stm->rowCount() <= 0)
            throw new Exception("Ocorreu um error ao inserir a serie!");

        return "Serie inserida com sucesso!";
    }
}