<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\ApiController;

SimpleRouter::get('/health', function() {
    $admin = new ApiController();
    $admin->health();
});

SimpleRouter::post('/register', function() {
    $data = new ApiController();
    $data->registerUser();
});

SimpleRouter::post('/login', function() {
    $data = new ApiController();
    $data->authenticateUser();
});

SimpleRouter::post('/logout', function() {
    $data = new ApiController();
    $data->unauthenticateUser();
});
