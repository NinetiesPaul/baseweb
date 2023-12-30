<?php

namespace App\Controllers;

use App\Http\Response;
use App\Http\Services\Authentication;

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
    
    public function registerUser()
    {
        $request = json_decode(file_get_contents('php://input'), true);

        $request['password'] = md5($request['password']);

        $authentication = new Authentication();
        $authentication->register($request);
        
        new Response([ 'success' => true, 'payload' => [
            'message' => 'USER_CREATED',
            'data' => []
        ] ]);
    }

    public function authenticateUser()
    {
        $request = json_decode(file_get_contents('php://input'), true);

        $request['password'] = md5($request['password']);

        $authentication = new Authentication();
        $payload = $authentication->authenticate($request);

        if (!$payload) {
            new Response([ 'success' => false, 'payload' => [
                'message' => 'USER_NOT_FOUND',
                'data' => []
            ] ], 404);
        }

        session_start();
        
        new Response([ 'success' => true, 'payload' => [
            'message' => 'AUTHENTICATION_SUCCESSFUL',
            'data' => $payload
        ] ]);
    }

    public function unauthenticateUser()
    {
        session_start();
        session_destroy();
    
        new Response([ 'success' => true, 'payload' => [
            'message' => 'LOGOUT_SUCCESSFFUL',
            'data' => []
        ] ]);
    }
}
