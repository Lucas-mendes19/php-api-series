<?php

namespace Lukelt\Api\Infrastructure\Repository;

use Exception;
use Lukelt\Api\Infrastructure\Persistence\Connection;
use Lukelt\Api\Entity\Serie;
use PDO;

class SerieRepository
{
    public readonly string $table;

    public function __construct() {
        $this->table = 'serie';
    }

    public function find(int $id): Serie
    {
        $stm = Connection::instance()->prepare("SELECT * FROM {$this->table} WHERE id = :id;");
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        $data = $stm->fetch(PDO::FETCH_ASSOC);
        if(!is_array($data))
            throw new Exception("Nenhuma serie encontrada!");

        return Serie::withIdNameSeasonEpísode(...$data);
    }

    public function all(): array
    {
        $stm = Connection::instance()->query("SELECT * FROM {$this->table};");

        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
        if(!is_array($data))
            throw new Exception("Nenhuma serie encontrada!");

        return array_map(fn (array $data) => Serie::withIdNameSeasonEpísode(...$data), $data);
    }

    public function insert($data): string
    {
        $sql = "INSERT INTO {$this->table} (name, season, episode) VALUES (:name, :season, :episode);";
        $stm = Connection::instance()->prepare($sql);
        $stm->bindValue(':name', $data['name']);
        $stm->bindValue(':season', $data['season']);
        $stm->bindValue(':episode', $data['episode']);
        $stm->execute();

        if ($stm->rowCount() <= 0)
            throw new Exception("Ocorreu um error ao inserir a serie!");

        return "Serie inserida com sucesso!";
    }
}