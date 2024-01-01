<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\AuthenticationController;
use App\Controllers\MainController;
use App\Controllers\UserController;

SimpleRouter::get('/', function() {
    $main = new MainController();
    $main->index();
});

SimpleRouter::get('/register', function() {
    $main = new MainController();
    $main->register();
});

SimpleRouter::get('/login', function() {
    $main = new MainController();
    $main->login();
});

SimpleRouter::post('/register', function() {
    $user = new UserController();
    $user->createUser();
});

SimpleRouter::get('/home', function() {
    $user = new UserController();
    $user->home();
});

SimpleRouter::get('/users', function() {
    $user = new UserController();
    $user->users();
});

SimpleRouter::get('/user/{id}', function($id) {
    $user = new UserController();
    $user->viewUser($id);
});

SimpleRouter::put('/user', function() {
    $user = new UserController();
    $user->updateUser();
});

SimpleRouter::delete('/user', function() {
    $user = new UserController();
    $user->deleteUser();
});

SimpleRouter::get('/logout', function() {
    $auth = new AuthenticationController();
    $auth->unauthenticateUser();
});

SimpleRouter::post('/login', function() {
    $auth = new AuthenticationController();
    $auth->authenticateUser();
});
