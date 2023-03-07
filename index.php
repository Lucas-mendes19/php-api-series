<?php

use Lukelt\Api\Models\Serie;

require __DIR__ . '/vendor/autoload.php';

if (isset($_SERVER['PATH_INFO'])) {
    $url = explode('/', $_SERVER['PATH_INFO']);
    
    
    if ($url[1] === 'api') {
        // api
    }
}

$serie = new Serie();

print_r($serie->get(1));
