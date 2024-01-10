<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\AuthenticationController;
use App\Controllers\UserController;
use App\Http\Middleware\Auth;
use App\Http\Middleware\NoAuth;

SimpleRouter::group(['middleware' => NoAuth::class], function () {

    SimpleRouter::get('/', function() {
        $user = new UserController();
        $user->index();
    });

    SimpleRouter::get('/login', function() {
        $user = new UserController();
        $user->login();
    });

    SimpleRouter::get('/register', function() {
        $user = new UserController();
        $user->register();
    });

    SimpleRouter::post('/register', function() {
        $user = new UserController();
        $user->createUser();
    });

    SimpleRouter::post('/login', function() {
        $auth = new AuthenticationController();
        $auth->authenticateUser();
    });
});

SimpleRouter::group(['middleware' => Auth::class], function () {
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
});
    
SimpleRouter::get('/logout', function() {
    $auth = new AuthenticationController();
    $auth->unauthenticateUser();
});
