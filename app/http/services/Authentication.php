<?php

namespace App\Http\Services;

use App\DB\Models\Users;
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
        $user = new Users([
            'name' => $data['name'],
            'password' => $data['password'],
            'email' => $data['email'],
        ]);

        $user->save();
    }

    public function authenticate($data)
    {
        $user = new Users([]);
        return $user->find($data, true);
    }

    public function unauthenticate()
    {

    }
}
