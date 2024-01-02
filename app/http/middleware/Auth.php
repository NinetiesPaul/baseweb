<?php

namespace App\Http\Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class Auth implements IMiddleware
{
    public function handle(Request $request): void
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            redirect('/');
        }
    }
}
