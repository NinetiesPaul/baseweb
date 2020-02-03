<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use App\Templates;

class IndexController
{   
    protected $template;

    public function __construct()
    {
        $this->template = new Templates();
    }
    
    public function index()
    {
        $templateFinal 	= $this->template->getTemplate('index.html');
        echo $templateFinal;
    }
}
