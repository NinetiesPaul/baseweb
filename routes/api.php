<?php

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\ApiController;

SimpleRouter::get('/health', function() {
    $admin = new ApiController();
    $admin->health();
});
