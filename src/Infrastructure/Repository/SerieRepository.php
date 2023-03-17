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

    public function insert(Serie $serie): string
    {
        $sql = "INSERT INTO {$this->table} (name, season, episode) VALUES (:name, :season, :episode);";
        $stm = Connection::instance()->prepare($sql);
        $stm->bindValue(':name', $serie->name);
        $stm->bindValue(':season', $serie->season);
        $stm->bindValue(':episode', $serie->episode);
        $stm->execute();

        if ($stm->rowCount() <= 0)
            throw new Exception("Ocorreu um error ao inserir serie!");

        return "Serie inserida com sucesso!";
    }

    public function update(Serie $serie): string
    {
        $sql = "UPDATE {$this->table} SET name = :name, season = :season, episode = :episode WHERE id = :id;";
        $stm = Connection::instance()->prepare($sql);
        $stm->bindValue(':name', $serie->name);
        $stm->bindValue(':season', $serie->season);
        $stm->bindValue(':episode', $serie->episode);
        $stm->bindValue(':id', $serie->id, PDO::PARAM_INT);
        $stm->execute();

        if ($stm->rowCount() <= 0)
            throw new Exception("Ocorreu um error ao editar serie!");

        return "Serie editada com sucesso!";
    }

    public function delete($id): string
    {
        $stm = Connection::instance()->prepare("DELETE FROM {$this->table} WHERE id = :id;");
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->execute();

        if ($stm->rowCount() <= 0)
            throw new Exception("Ocorreu um erro ao excluir serie!");

        return "Serie excluida com sucesso!";
    }
}