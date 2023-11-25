<?php

namespace App\Http;

class Response {

    public function __construct($content, $code = 200)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);
        echo json_encode($content, JSON_PRETTY_PRINT);
        die();
    }
}
