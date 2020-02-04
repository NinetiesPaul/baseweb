<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\IndexController;
use App\Controllers\DataController;

SimpleRouter::get('/baseweb/', function() {
    $admin = new IndexController();
    $admin->index();
});

SimpleRouter::get('/baseweb/dados', function() {
    $admin = new DataController();
    $admin->verDados();
});

SimpleRouter::get('/baseweb/dado/{idDado}', function($idDado) {
    $admin = new DataController();
    $admin->verDado($idDado);
});

SimpleRouter::delete('/baseweb/dado/{idDado}/delete', function($idDado) {
    $admin = new DataController();
    $admin->removerDado($idDado);
});

SimpleRouter::put('/baseweb/dado', function() {
    $admin = new DataController();
    $admin->alterarDado();
});

SimpleRouter::post('/baseweb/dado', function() {
    $admin = new DataController();
    $admin->inserirDado();
});