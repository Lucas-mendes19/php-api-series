<?php

namespace Lukelt\Api\Controller;

use InvalidArgumentException;
use Lukelt\Api\Entity\Serie;
use Lukelt\Api\Infrastructure\Repository\SerieRepository;

class SerieController
{
    private SerieRepository $serie;

    public function __construct()
    {
        $this->serie = new SerieRepository();
    }

    public function get(int $id = null): Serie|array
    {
        if (isset($id))
            return $this->serie->find($id);

        return $this->serie->all();
    }

    public function post(): string
    {
        $data = $this->request();

        $serie = new Serie($data['name'], $data['season'], $data['episode']);

        if (isset($data['id'])) {
            $serie->setId($data['id']);
            return $this->serie->update($serie);
        }

        return $this->serie->insert($serie);
    }

    public function put(): string
    {
        $data = $this->request();

        if (!isset($data['id']))
            throw new InvalidArgumentException("Informe um Id!");
        
        $serie = Serie::withIdNameSeasonEpísode($data['id'], $data['name'], $data['season'], $data['episode']);
        return $this->serie->update($serie);
    }

    public function delete(int $id = null): string
    {
        if (!isset($id))
            throw new InvalidArgumentException("Informe um Id!");

        return $this->serie->delete($id);
    }

    public function request(): array
    {
        $request = file_get_contents('php://input');
        $data = json_decode($request, true) ?: $_POST;
        $this->diff($data);

        return $data;
    }

    public function diff($data): void
    {
        $keys = array_keys($data);
        $compare = [
            'name',
            'season',
            'episode'
        ];

        $diff = array_diff($compare, $keys);

        if (count($diff) > 0)
            throw new InvalidArgumentException("Não foi informado " . implode(',', $diff) . "!");
    }
}