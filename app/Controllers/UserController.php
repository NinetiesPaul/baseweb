<?php

namespace App\Controllers;

use App\Http\Services\Users;
use App\Templates;

class UserController
{
    public function home()
    {
        new Templates('home.html');
    }

    public function register()
    {
        $request = input()->all();

        $request['password'] = md5($request['password']);

        $userService = new Users();
        $userService->create($request);

        redirect('/');
    }
}
