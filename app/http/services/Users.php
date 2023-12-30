<?php

namespace App\Http\Services;

use App\DB\Models\Users as ModelsUsers;

class Users
{
    public function __construct()
    {
        
    }

    public function create($data)
    {
        $user = new ModelsUsers([
            'name' => $data['name'],
            'password' => $data['password'],
            'email' => $data['email'],
        ]);

        $user->save();
    }
}
