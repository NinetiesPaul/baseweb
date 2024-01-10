<?php

namespace App\Http\Services;

use App\DB\Models\Users;

class Authentication
{
    public function __construct()
    {
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
