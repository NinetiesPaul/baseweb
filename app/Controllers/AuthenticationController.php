<?php

namespace App\Controllers;

use App\Http\Services\Authentication;

class AuthenticationController
{
    public function authenticateUser()
    {
        $request = input()->all();

        $request['password'] = md5($request['password']);

        $authentication = new Authentication();
        $user = $authentication->authenticate($request);

        if ($user) {
            session_start();
            redirect('/home');
        } else {
            redirect('/login');
        }
    }

    public function unauthenticateUser()
    {
        session_start();
        session_destroy();

        redirect('/');
    }
}
