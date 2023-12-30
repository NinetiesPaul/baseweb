<?php

namespace App\Controllers;

use App\Templates;

class MainController
{   
    public function __construct()
    {
    }
    
    public function index()
    {
        new Templates('index.html');
    }

    public function login()
    {
        session_start();

        $msg = '';
        if ($_SESSION['error_msg']) {
            $msg = $_SESSION['error_msg'];
            unset($_SESSION['error_msg']);
        }

        new Templates('login.html', [ 'MSG' => $msg ]);
    }
    
    public function register()
    {
        new Templates('register.html');
    }
}
