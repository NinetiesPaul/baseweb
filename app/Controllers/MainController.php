<?php

namespace App\Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class MainController
{   
    protected $templating;

    public function __construct()
    {
        $loader = new FilesystemLoader('templates');
        $this->templating = new Environment($loader, []);
    }
    
    public function index()
    {
        echo $this->templating->render('index.html', []);
    }

    public function login()
    {
        session_start();

        $msg = '';
        if ($_SESSION['error_msg']) {
            $msg = $_SESSION['error_msg'];
            unset($_SESSION['error_msg']);
        }

        echo $this->templating->render('login.html', [ 'error_msg' => $msg ]);
    }
    
    public function register()
    {
        session_start();

        $violations = '';
        if ($_SESSION['violations']) {
            $violations = $_SESSION['violations'];
            unset($_SESSION['violations']);
        }

        echo $this->templating->render('register.html', [ 'violations' => $violations ]);
    }
}
