<?php

namespace Lukelt\Api\Controller;

use Lukelt\Api\Models\Serie;

class SerieService
{
    private Serie $serie;

    public function __construct()
    {
        $this->serie = new Serie();
    }

    public function get(int $id = null)
    {
        if (isset($id))
            return $this->serie->select($id);

        return $this->serie->all();
    }

    public function post()
    {
        $data = $_POST;

        return $this->serie->insert($data);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}