<?php

namespace Lukelt\Api\Controller;

use Lukelt\Api\Models\Serie;

class SerieService {
    public function get(int $id = null)
    {
        if (isset($id))
            return Serie::select($id);

        return Serie::all();
    }

    public function post()
    {
        $data = $_POST;

        return Serie::insert($data);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}