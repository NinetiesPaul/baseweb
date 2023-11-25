<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
}
