<?php

namespace App\Controllers;

use App\Http\Response;

class ApiController
{

    public function __construct()
    {
    }
    
    public function health()
    {
        new Response([
            'success' => true,
            'payload' => [
                'message' => "API is healthy!",
                'data' => []
            ]
        ]);
    }
}
