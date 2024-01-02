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

        session_start();
        if ($user) {
            $_SESSION['user'] = $user;
            redirect('/home');
        } else {
            $_SESSION['error_msg'] = 'AUTH_FAILED';
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
