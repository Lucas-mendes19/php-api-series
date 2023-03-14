<?php

namespace Lukelt\Api\Controller;

use Lukelt\Api\Infrastructure\Repository\SerieRepository;

class SerieController
{
    private SerieRepository $serie;

    public function __construct()
    {
        $this->serie = new SerieRepository();
    }

    public function get(int $id = null)
    {
        if (isset($id))
            return $this->serie->find($id);

        return $this->serie->all();
    }

    public function post()
    {
        $request = file_get_contents('php://input');
        $data = json_decode($request, true) ?: $_POST;

        return $this->serie->insert($data);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}