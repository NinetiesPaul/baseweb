<?php

namespace App\Http\Services;

use App\DB\Models\UsersModels;
use App\DB\Storage;

class Authentication
{
    protected $storage;

    public function __construct()
    {
        $this->storage = new Storage();
    }

    public function register($data)
    {
        $user = new UsersModels([
            'name' => $data['name'],
            'password' => $data['password'],
            'email' => $data['email'],
        ]);

        $user->save();
    }

    public function authenticate($data)
    {
        $user = new UsersModels([]);
        return $user->find($data, true);
    }

    public function unauthenticate()
    {

    }
}
