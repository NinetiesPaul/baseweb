<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\MainController;
use App\Controllers\DataController;

SimpleRouter::get('/', function() {
    $admin = new MainController();
    $admin->index();
});

SimpleRouter::get('/dados', function() {
    $admin = new DataController();
    $admin->verDados();
});

SimpleRouter::get('/dado/{idDado}', function($idDado) {
    $admin = new DataController();
    $admin->verDado($idDado);
});

SimpleRouter::delete('/dado/{idDado}/delete', function($idDado) {
    $admin = new DataController();
    $admin->removerDado($idDado);
});

SimpleRouter::put('/dado', function() {
    $admin = new DataController();
    $admin->alterarDado();
});

SimpleRouter::post('/dado', function() {
    $admin = new DataController();
    $admin->inserirDado();
});
