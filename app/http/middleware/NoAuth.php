<?php

namespace App\Http\Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class NoAuth implements IMiddleware
{
    public function handle(Request $request): void
    {
        session_start();

        if (isset($_SESSION['user'])) {
            redirect('/home');
        }
    }
}
