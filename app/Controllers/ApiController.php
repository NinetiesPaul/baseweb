<?php

namespace App\Controllers;

use App\DB\Models\UsersModels;
use App\DB\Storage;
use App\Http\Response;

class ApiController
{
    protected $storage;

    public function __construct()
    {
        $this->storage = new Storage();
    }
    
    public function health()
    {
        new Response([
            'success' => true,
            'payload' => "API is healthy!"
        ]);
    }
    
    public function registerUser()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        
        $newUser = new UsersModels();
        $this->storage->save($newUser, $request);
        
        new Response([ 'success' => true, 'payload' => '' ]);
    }
}
