<?php

use Lukelt\Api\Models\Serie;

require __DIR__ . '/vendor/autoload.php';

if (isset($_SERVER['PATH_INFO'])) {
    $url = explode('/', $_SERVER['PATH_INFO']);
    
    
    if ($url[1] === 'api') {
        $service = 'Lukelt\Api\Controller\\' . ucfirst($url[2]) . 'Service';
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $arg = $url[3] ?? null;
        
        try {
            $response = call_user_func_array([new $service, $method], [$arg]);

            echo json_encode([
                'status' => 'sucess',
                'data' => $response
            ]);
            
            exit();
        } catch (\Throwable $th) {
            echo json_encode([
                'status' => 'error',
                'data' => $th->getMessage()
            ]);

            exit();
        }
    }
}