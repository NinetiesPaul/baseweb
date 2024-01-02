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
}
