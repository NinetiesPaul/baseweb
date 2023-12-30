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
        new Templates('login.html');
    }
    
    public function register()
    {
        new Templates('register.html');
    }
}
