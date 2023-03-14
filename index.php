<?php

header("Content-type: application/json; charset=utf-8");

require __DIR__ . '/vendor/autoload.php';

if (isset($_SERVER['PATH_INFO'])) {
    $url = array_filter(explode('/', $_SERVER['PATH_INFO']));
    
    if ($url[1] === 'api') {
        $service = 'Lukelt\Api\Controller\\' . ucfirst($url[2]) . 'Controller';
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $arg = $url[3] ?? null;

        try {
            $response = call_user_func_array([new $service, $method], [$arg]);

            http_response_code(200);
            echo json_encode([
                'status' => 'sucess',
                'data' => $response
            ], JSON_UNESCAPED_UNICODE);
            
            exit();
        } catch (\Throwable $th) {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'data' => $th->getMessage()
            ], JSON_UNESCAPED_UNICODE);

            exit();
        }
    }
}